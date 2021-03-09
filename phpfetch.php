<head>
  <title>PHPfetch</title>
  <link rel="shortcut icon" href="favicon.png" type="image/png"/>
  <meta charset="UTF-8">
</head>

<style>
  body {
    background: black;
    color: white;
  }
  .logo {
    background-image: repeating-linear-gradient(45deg, violet, indigo, blue, green, yellow, orange, red, violet);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
  .output {
    border: 5px solid #933699;
    display: table;
    padding: 10px;
  }
  td {
    padding: 5px;
  }
</style>

<body>
  <pre class="logo">
 ,ggggggggggg,   ,ggg,        gg  ,ggggggggggg,
dP"""88""""""Y8,dP""Y8b       88 dP"""88""""""Y8, ,dPYb,             I8              ,dPYb,
Yb,  88      `8bYb, `88       88 Yb,  88      `8b IP'`Yb             I8              IP'`Yb
 `"  88      ,8P `"  88       88  `"  88      ,8P I8  8I          88888888           I8  8I
     88aaaad8P"      88aaaaaaa88      88aaaad8P"  I8  8'             I8              I8  8'
     88"""""         88"""""""88      88"""""     I8 dP    ,ggg,     I8      ,gggg,  I8 dPgg,
     88              88       88      88          I8dP    i8" "8i    I8     dP"  "Yb I8dP" "8I
     88              88       88      88          I8P     I8, ,8I   ,I8,   i8'       I8P    I8
     88              88       Y8,     88         ,d8b,_   `YbadP'  ,d88b, ,d8,_    _,d8     I8,
     88              88       `Y8     88         PI8"8888888P"Y88888P""Y88P""Y8888PP88P     `Y8
                                                  I8 `8,
                                                  I8  `8,
                                                  I8   8I
                                                  I8   8I
                                                  I8, ,8'
                                                   "Y8P'
  </pre>
  <!-- This PHP block will gather information and assemble it all into an array called `output`. -->
  <?php
    /* CPU */
    $cpu_file = fopen("/proc/cpuinfo", "r");
    error_reporting (E_ALL ^ E_NOTICE);
    while(($line = fgetcsv($cpu_file, 0, ":")) !== FALSE) {
      $lines_array_cpu[] = $line[1];
    }
    fclose($cpu_file);
    $cpu = $lines_array_cpu[4];
    
    /* Distro */
    $distro_file = fopen("/etc/os-release", "r");
    while(($line = fgetcsv($distro_file, 0, "=")) !== FALSE) {
      $lines_array_distro[] = $line[1];
    }
    fclose($distro_file);
    $distro = $lines_array_distro[2];
    
    /* Editor */
    $editor = getenv("EDITOR");
    
    /* Hostname */
    $hostname = file_get_contents("/etc/hostname", "r");
    
    /* Kernel */
    $kernel = file_get_contents("/proc/sys/kernel/osrelease");

    /* Music */
    $music = shell_exec("rsmpc current");
    
    /* Package count */
    $pkg_list = array_filter(glob("/var/db/pkg/*/*/"), "is_dir");
    $pkgs = count($pkg_list, 0);
    
    /* Shell */
    $shell = getenv("SHELL");

    /* Uptime */
    $uptime_pre = file_get_contents("/proc/uptime");
    $uptime_array = explode(".", $uptime_pre);
    $uptime = $uptime_array[0];
    
    if ($uptime > 86400) {
      $days_pre = $uptime / 60 / 60 / 24;
      $days_pre = explode(".", $days_pre);
      $days = ($days_pre[0] . "d");
    } else {
      $days = "";
    }
    
    if ($uptime > 3600) {
      $hours_pre = ($uptime / 60 / 60) % 24;
      $hours = ($hours_pre . "h");
    } else {
      $hours = "";
    }
    
    if ($uptime > 60) {
      $minutes_pre = ($uptime / 60) % 60;
      $minutes = ($minutes_pre . "m");
    } else {
        $minutes = "less than one minute";
    }

    $uptime_message = ($days . " " . $hours . " " . $minutes);

    /* User */
    $user = getenv("USER");
    
    /* Asseble output into an array*/
    $output = array(
                array("title"=>"CPU", "Info"=>"$cpu"),
                array("title"=>"Distro", "Info"=>"$distro"),
                array("title"=>"Editor", "Info"=>"$editor"),
                array("title"=>"Hostname", "Info"=>"$hostname"),
                array("title"=>"Kernel", "Info"=>"$kernel"),
                array("title"=>"Packages (Portage)", "Info"=>"$pkgs"),
                array("title"=>"Shell", "Info"=>"$shell"),
                array("title"=>"Uptime", "Info"=>"$uptime_message"),
                array("title"=>"User", "Info"=>"$user"),
                array("title"=>"Music", "Info"=>"$music")
              );
  ?>

  <!-- Generate and output the table based on the elements in the array. -->
  <?php if (count($output) > 0): ?>
    <table class="output">
      <tbody>
        <?php foreach ($output as $row): array_map('htmlentities', $row); ?>
        <tr>
          <td><?php echo implode('</td><td>', $row);?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
  Created by -- <a href="https://Phate6660.codeberg.page">Phate6660</a>
</body>
