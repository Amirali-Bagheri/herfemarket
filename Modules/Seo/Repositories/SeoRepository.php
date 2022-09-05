<?php

namespace Modules\Seo\Repositories;

class SeoRepository implements SeoRepositoryInterface
{
    public function onpage_seo()
    {
        error_reporting(E_ALL);
        set_time_limit(300);
        include_once('../src/SimpleCrawler.php');

        $url_to_crawl = $argv[1];
        $depth = isset($argv[2]) ? $argv[2] : 3;

        if (!$url_to_crawl) {
            return;
        }

        echo "Begin crawling " . $url_to_crawl . ' with links in depth ' . $depth . chr(10);

        $start_time = time();
        $simple_crawler = new simpleCrawler($url_to_crawl, $depth);
        $simple_crawler->traverse();
        $links_data = $simple_crawler->getLinksInfo();

        $end_time = time();

        $duration = $end_time - $start_time;
        echo 'crawling approximate duration, ' . $duration . ' seconds' . chr(10);
        echo count($links_data) . " unique links found" . chr(10);

        mysql_connect('localhost', 'root', 'root');
        mysql_select_db('crawler_database');
        foreach ($links_data as $uri => $info) {
            if (!isset($info['status_code'])) {
                $info['status_code'] = 000;//tmp
            }

            $h1_contents = implode("\n\r", isset($info['h1_contents']) ? $info['h1_contents'] : array());
            $original_urls = implode('\n\r', isset($info['original_urls']) ? $info['original_urls'] : array());
            $links_text = implode('\n\r', isset($info['links_text']) ? $info['links_text'] : array());
            $is_external = $info['external_link'] ? '1' : '0';
            $title = @$info['title'];
            $h1_count = isset($info['h1_count']) ? $info['h1_count'] : 0;

            $sql_query = "insert into pages_crawled(url, frequency, status_code, is_external, title, h1_count, h1_content, source_link_text, original_urls)
values('$uri', {$info['frequency']}, {$info['status_code']}, {$is_external}, '{$title}', {$h1_count}, '$h1_contents', '$links_text', '$original_urls')";

            mysql_query($sql_query) or die($sql_query);
        }
    }
}
