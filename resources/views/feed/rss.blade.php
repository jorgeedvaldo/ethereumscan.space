<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
  <channel>
    <title>{{ config('app.name') }} - Feed</title>
    <link>{{ url('/') }}</link>
    <description>Latest published articles</description>

    @foreach($posts as $post)
      <item>
        <title><![CDATA[{{ $post->title }}]]></title>
        <link>{{ url('/blog/' . $post->slug) }}</link>
        <guid>{{ url('/blog/' . $post->slug) }}</guid>
        <pubDate>{{ $post->created_at->toRssString() }}</pubDate>
        <description><![CDATA[{!! Str::limit($post->body, 200) !!}]]></description>
      </item>
    @endforeach
  </channel>
</rss>
