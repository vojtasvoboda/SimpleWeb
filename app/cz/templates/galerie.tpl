<section id="section" class="span12">
	<h1>Textová stránka</h1>
	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
	<div class="reseter"></div>
	
	<h2>Galerie</h2>
	
	<div class="galerie">
		{foreach from=$images item=i}
		<a href="/assets/img/colorbox/{$i}" rel="lightbox">
			<img src="/assets/img/colorbox/{$i}" alt="{$i}" />
		</a>
		{/foreach}
	</div>
	
</section>
