<?php
// Page title - can be overridden by each view
$pageTitle = $pageTitle ?? 'Registro de incidencias';
?>

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title><?php echo $pageTitle; ?></title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />

  <!-- Material Symbols -->
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />

  <!-- Tailwind Config -->
  <?php include_once 'config/tailwind.php'; ?>

  <!-- Custom CSS -->
  <link href="css/styles.css" rel="stylesheet" />

  <!-- API Base URL (dynamic for subdirectory or root) -->
  <script>const API_BASE = '<?php echo $apiBase; ?>';</script>

  <!-- Shared JavaScript Utilities -->
  <script src="js/utils.js"></script>
</head>