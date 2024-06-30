<?php header('Content-type: application/rss+xml; charset=utf-8'); ?>
<?php echo '<?xml version="1.0" encoding="'.$encoding.'"?>'; ?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns:admin="http://webns.net/mvcb/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:content="http://purl.org/rss/1.0/modules/content/">
    <channel>
        <title><?php echo $feed_name; ?></title>
        <description><?php echo $page_description; ?></description>
        <link><?php echo $feed_url; ?></link>
        <?php foreach ($posts->result_array() as $post) : ?>
            <item>
                <title><?php echo xml_convert($post['judul']); ?></title>
                <link><?php echo 'https://ptwp-pusat.org/main/page/' . $post['alias']; ?></link>          
                <guid isPermaLink="true"><?php echo 'https://ptwp-pusat.org/main/page/' . $post['alias']; ?></guid>                
                <description><![CDATA[<?php echo strip_tags(html_entity_decode($post['isi'])); ?>]]></description>
            </item>
        <?php endforeach; ?>
    </channel>
</rss>