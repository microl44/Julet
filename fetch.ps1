$a = $args[0]

$url = "https://github.com/microl44/Julet/issues/" + $a
$url_html = Invoke-WebRequest -Uri $url

$object = $url_html.ParsedHtml.body.getElementsByTagName('td')[0] | where { $_.className -eq "d-block comment-body markdown-body  js-comment-body" }

return $object.IHTMLElement_innerText.Trim()
#Write-Output $url_html.ParsedHtml.body.getElementsByTagName("p")[3]

#$info = $url_html.ParsedHtml.body.getElementsByTagName('div') | where {$_.getAttributeNode('class').Value -eq "edit-comment-hide"}
#Write-Output $info