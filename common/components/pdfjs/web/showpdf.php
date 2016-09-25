<?php

/**
 * 如果跨域，就使用本文件
 */
if (!empty($_GET['file'])) {
    $newurl = 'showpdf.php?readfile=' . $_GET['file'];
    header('Location: viewer.html?file=' . urlencode($newurl));
}
if (!empty($_GET['readfile'])) {
    echo file_get_contents($_GET['readfile']);
}
