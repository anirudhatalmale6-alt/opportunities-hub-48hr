<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:atom="http://www.w3.org/2005/Atom">
<xsl:output method="html" encoding="UTF-8" />
<xsl:template match="/">
<html>
<head>
<title><xsl:value-of select="/rss/channel/title" /></title>
<style>
body{font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif;max-width:800px;margin:0 auto;padding:20px;background:#f5f5f5;color:#333}
.header{background:linear-gradient(135deg,#0d1b4a,#1a237e);color:#fff;padding:30px;border-radius:12px;margin-bottom:30px}
.header h1{margin:0 0 8px;font-size:24px}
.header p{margin:0;opacity:0.85;font-size:14px}
.badge{display:inline-block;background:rgba(255,255,255,0.2);padding:6px 14px;border-radius:20px;font-size:12px;margin-top:15px}
.item{background:#fff;border-radius:10px;padding:20px;margin-bottom:16px;box-shadow:0 2px 8px rgba(0,0,0,0.08)}
.item h2{margin:0 0 8px;font-size:18px}
.item h2 a{color:#1a237e;text-decoration:none}
.item h2 a:hover{text-decoration:underline}
.item .date{color:#999;font-size:13px;margin-bottom:10px}
.item .desc{color:#555;font-size:14px;line-height:1.6}
.item .cats{margin-top:10px}
.item .cat{display:inline-block;background:#e3f2fd;color:#1565c0;padding:3px 10px;border-radius:12px;font-size:12px;margin-right:6px}
.info{text-align:center;color:#999;font-size:13px;padding:20px}
</style>
</head>
<body>
<div class="header">
<h1><xsl:value-of select="/rss/channel/title" /></h1>
<p><xsl:value-of select="/rss/channel/description" /></p>
<div class="badge">RSS Feed — Subscribe in your favorite reader</div>
</div>
<xsl:for-each select="/rss/channel/item">
<div class="item">
<h2><a href="{link}" target="_blank"><xsl:value-of select="title" /></a></h2>
<div class="date"><xsl:value-of select="pubDate" /></div>
<div class="desc"><xsl:value-of select="description" /></div>
<xsl:if test="category">
<div class="cats">
<xsl:for-each select="category">
<span class="cat"><xsl:value-of select="." /></span>
</xsl:for-each>
</div>
</xsl:if>
</div>
</xsl:for-each>
<div class="info">Copy the URL from your browser's address bar and paste it into your RSS reader to subscribe.</div>
</body>
</html>
</xsl:template>
</xsl:stylesheet>
