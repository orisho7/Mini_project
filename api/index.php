<?php
// api/index.php - Router for Vercel and Local Development

$uri = $_SERVER['REQUEST_URI'] ?? '/';

// Strip query string
$uri = parse_url($uri, PHP_URL_PATH);

// Normalize path by stripping trailing slashes
if ($uri !== '/' && str_ends_with($uri, '/')) {
    $uri = substr($uri, 0, -1);
}

// Serve static assets directly for local development (php -S)
// Vercel handles static assets automatically via filesystem handler,
// but local php -S needs this to resolve files in assets/.
$ext = pathinfo($uri, PATHINFO_EXTENSION);
$static_extensions = ['css', 'js', 'jpg', 'jpeg', 'png', 'gif', 'svg', 'mp4', 'webm', 'ico'];

if (in_array(strtolower($ext), $static_extensions)) {
    $asset_file = __DIR__ . '/..' . $uri;
    if (file_exists($asset_file)) {
        return false; // Let local PHP server handle static file serving
    }
}

// Helper to resolve paths case-insensitively for cross-platform compatibility (Windows vs Linux/Vercel)
function resolve_path_case_insensitive($path) {
    if (file_exists($path)) {
        return $path;
    }
    $directory = dirname($path);
    $filename = strtolower(basename($path));
    if (!is_dir($directory)) {
        return null;
    }
    $items = scandir($directory);
    foreach ($items as $item) {
        if ($item !== '.' && $item !== '..' && strtolower($item) === $filename) {
            return $directory . '/' . $item;
        }
    }
    return null;
}

// Map clean URIs to PHP files
$file = null;

if ($uri === '/' || $uri === '/index' || $uri === '/index.php') {
    $file = __DIR__ . '/../index.php';
} elseif (str_starts_with($uri, '/pages/')) {
    $subPath = substr($uri, 7);
    if (!str_ends_with($subPath, '.php') && !str_contains($subPath, '.')) {
        $subPath .= '.php';
    }
    $file = resolve_path_case_insensitive(__DIR__ . '/../pages/' . $subPath);
} elseif (str_starts_with($uri, '/auth/')) {
    $subPath = substr($uri, 6);
    if (!str_ends_with($subPath, '.php') && !str_contains($subPath, '.')) {
        $subPath .= '.php';
    }
    $file = resolve_path_case_insensitive(__DIR__ . '/../auth/' . $subPath);
} elseif (str_starts_with($uri, '/includes/')) {
    $subPath = substr($uri, 10);
    $file = resolve_path_case_insensitive(__DIR__ . '/../includes/' . $subPath);
}

// Fallback logic: check if clean URL exists inside /pages/ (e.g. /Voting -> /pages/Voting.php)
if (!$file) {
    $subPath = ltrim($uri, '/');
    if (!str_ends_with($subPath, '.php') && !str_contains($subPath, '.')) {
        $subPath .= '.php';
    }
    $resolved_pages = resolve_path_case_insensitive(__DIR__ . '/../pages/' . $subPath);
    if ($resolved_pages && file_exists($resolved_pages)) {
        $file = $resolved_pages;
    }
}

if ($file && file_exists($file)) {
    // Set execution directory to the file's directory to ensure relative includes work
    chdir(dirname($file));
    require basename($file);
    exit();
}

// Fallback to 404
http_response_code(404);
echo "404 Not Found: " . htmlspecialchars($uri);
