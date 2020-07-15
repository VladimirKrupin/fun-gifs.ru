{{ Request::header('Content-Type : text/xml') }}
<?php echo '<?xml version="1.0" encoding="UTF-8"?>';?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://gifkawood.ru/</loc>
        <changefreq>monthly</changefreq>
        <priority>1</priority>
    </url>

    @foreach ($tags as $tag)
        <url>
            <loc>{{ url($tag->link) }}</loc>
            <lastmod>{{ $tag->updated_at->tz('GMT')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>1</priority>
        </url>
    @endforeach

    @foreach ($posts as $post)
        <url>
            <loc>{{ url($post->link) }}</loc>
            <lastmod>{{ $post->updated_at->tz('GMT')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>1</priority>
        </url>
    @endforeach

</urlset>
