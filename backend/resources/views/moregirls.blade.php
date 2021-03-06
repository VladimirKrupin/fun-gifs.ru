{{ Request::header('Content-Type : text/xml') }}
<?php echo '<?xml version="1.0" encoding="UTF-8"?>';?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://gifkawood.ru/moregirls</loc>
        <changefreq>monthly</changefreq>
        <priority>1</priority>
    </url>

    @foreach ($posts_moregirls as $posts_moregirl)
        <url>
            <loc>{{ url($posts_moregirl->moregirls) }}</loc>
            <lastmod>{{ $posts_moregirl->updated_at->tz('GMT')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>1</priority>
        </url>
    @endforeach
</urlset>
