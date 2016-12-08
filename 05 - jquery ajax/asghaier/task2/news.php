<!DOCTYPE html>
<html>
<head>
	<title>News</title>
	<script src="../bower_components/jquery/dist/jquery.min.js"></script>
	<link rel="stylesheet" href="style.css">
	<script type="text/javascript">
		$(document).ready(function(){
			var news_url = 'https://newsapi.org/v1/sources?language=en';
			var loadElm = $('<img src="22.gif" class="load_progress" style="position:absolute; width:200px; height: 150px">');
			$('#news_liste').append(loadElm);
			$.get(
				news_url
			).done(function(items){
				
				items.sources.forEach(function(item){
					var trElm = $('<tr>');
					var tdElm = $('<td align="center">');
					var imgElm = $('<img class="item">');
					imgElm.attr('src', item.urlsToLogos.small);
					imgElm.attr('id', item.id);
					tdElm.append(imgElm);
					trElm.append(tdElm);
					$('#items_list').append(trElm);
				});
				loadElm.hide();
				$('#items_list td').css({'display': 'block'});

				$('.item').on('click', function(element){
					//console.log(element.attr('id'));
					var source_url = "https://newsapi.org/v1/articles";
					var source_id = element.currentTarget.id;
					$.get(
						source_url,
						{
							apiKey:"df81cdbb05b94d69a4b6c83689c04c65",
							source:source_id
						}
					).done(function(contents){
						$('#contents').empty();
						contents.articles.forEach(function(article){
							var divElm = $('<div class="article">');
							var titleElm = $('<h3>');
							var descElm = $('<div class="desc">');
							var linkElm = $('<a target="_blank">').text('more');
							var dateElm = $('<span class="publish_date">')
							var imgElm = $('<img class="article_img">');
							var loadElm = $('<img src="22.gif" class="load_progress">');

							titleElm.text(article.title);
							imgElm.attr('src', article.urlToImage);
							dateElm.append(article.publishedAt);
							descElm.text(article.description);
							descElm.append('<br>');
							linkElm.attr('href', article.url);
							descElm.append(linkElm);
							descElm.append('<br>');
							descElm.append(dateElm);
							
							
							
							divElm.append(titleElm);
							divElm.append(loadElm);
							divElm.append(imgElm);
							divElm.append(descElm);
							$('#contents').append(divElm);

							imgElm.on('load',function(){
								loadElm.hide();
								imgElm.css({'display': 'block'});
							})
							
						});
					//	$('#items_list').css({'height':$(document).width()});
						console.log(contents);
					});
					//console.log(element.currentTarget.id);
					
				})
			});

			
		});
	</script>
</head>
<body>
<div id="news_liste">
	<table width='100%' id="items_list">
	</table>
</div>
<div id="contents">
	<p style="width: 100%;
    text-align: center;
    position: absolute;
    display: table-cell;
    line-height: 20;
    font-style: oblique;
    font-weight: bolder;
    font-size: 20pt;
    color: rgba(48, 45, 156, 0.74);"> 
		Please choose a new's source from the sourcelist at Left.
	</p>
</div>
</body>
</html>