{{ Request::header('Content-Type : text/xml') }}
<?php echo '<?xml version="1.0" encoding="UTF-8"?>';?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://gifkawood.ru/</loc>
        <changefreq>monthly</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>https://gifkawood.ru/</loc>
        <changefreq>monthly</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>https://gifkawood.ru/</loc>
        <changefreq>monthly</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>https://gifkawood.ru/</loc>
        <changefreq>monthly</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>https://gifkawood.ru/</loc>
        <changefreq>monthly</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>https://gifkawood.ru/</loc>
        <changefreq>monthly</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>https://gifkawood.ru/tags/smeshnoe-video-prikoly</loc>
        <changefreq>monthly</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>https://gifkawood.ru/tags/kotiki-video-prikoly</loc>
        <changefreq>monthly</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>https://gifkawood.ru/tags/devushki-video-prikoly</loc>
        <changefreq>monthly</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>https://gifkawood.ru/tags/ne-lovko-vishlo-video-prikoly</loc>
        <changefreq>monthly</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>https://gifkawood.ru/tags/shokiruyushchie-video-prikoly</loc>
        <changefreq>monthly</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>https://gifkawood.ru/tags/zalipatel'no-video-prikoly</loc>
        <changefreq>monthly</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>https://gifkawood.ru/tags/avto-video-prikoly</loc>
        <changefreq>monthly</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>https://gifkawood.ru/tags/interesnoe-video-prikoly</loc>
        <changefreq>monthly</changefreq>
        <priority>1</priority>
    </url>

    @foreach ($posts as $post)
        <url>
            <loc>{{ url($post->link) }}</loc>
            <lastmod>{{ $post->updated_at->tz('GMT')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>1</priority>
        </url>
    @endforeach
</urlset>