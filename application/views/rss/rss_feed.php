<?php
header("Content-Type: application/rss+xml; charset=ISO-8859-1");
echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
?>

<rss version="2.0">
  <channel>
    <title>Feed Berita PTWP Daerah</title>
    <link>https://ptwp-pusat.org/main/berita_ptwp_daerah</link>
    <description>Berita PTWP Daerah</description>
    <language>id-ID</language>
    <pubDate><?php echo date("D, d M Y H:i:s O"); ?></pubDate>
    <lastBuildDate><?php echo date("D, d M Y H:i:s O"); ?></lastBuildDate>
    <generator>PHP</generator>

    <?php
    // Hubungkan ke database Anda (gantilah dengan koneksi sesuai dengan database Anda)
    $koneksi = new mysqli("localhost", "username", "password", "nama_database");

    // Periksa koneksi
    if ($koneksi->connect_error) {
        die("Koneksi database gagal: " . $koneksi->connect_error);
    }

    // Query untuk mengambil data berita dari database (gantilah dengan query sesuai dengan tabel Anda)
    $query = "SELECT title, link, description FROM nama_tabel_berita";
    $result = $koneksi->query($query);

    // Loop untuk menambahkan setiap item berita ke dalam feed
    while ($row = $result->fetch_assoc()) {
        echo '<item>';
        echo '<title>' . htmlspecialchars($row['title']) . '</title>';
        echo '<link>' . htmlspecialchars($row['link']) . '</link>';
        echo '<description>' . htmlspecialchars($row['description']) . '</description>';
        echo '<pubDate>' . date("D, d M Y H:i:s O") . '</pubDate>';
        echo '</item>';
    }

    // Tutup koneksi database
    $koneksi->close();
    ?>

  </channel>
</rss>
