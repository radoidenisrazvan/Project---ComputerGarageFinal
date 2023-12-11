<?php
// update_sort.php

// Verificăm dacă a fost trimisă variabila sort prin GET
if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];

    // Aici puteți efectua orice altă logica necesară pentru actualizarea variabilei $sort

    // Răspuns pentru JavaScript
    echo "Sort updated to: " . $sort;
}
?>
