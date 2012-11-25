<section id="section" class="span12">

	<h1>{$data.title}</h1>

	<p>Kontakty text</p>
	
	<div class="reseter"></div>
	<br />

	<h2 id="form">Kontaktní formulář</h2>

	{if $error}
	<p class="alert alert-error"><strong>Pozor!</strong> Pro odeslání formuláře je potřeba vyplnit všechna políčka označená hvězdičkou!
		<button type="button" class="close" data-dismiss="alert">×</button>
	</p>
	{/if}

	{if $error_email}
	<p class="alert alert-error">
		<strong>Pozor!</strong> Vámi zadaný email má špatný tvar!
		<button type="button" class="close" data-dismiss="alert">×</button>
	</p>
	{/if}

	{if $ok}
	<p class="alert alert-success">
		Zpráva byla úspěšně odeslána!
		<button type="button" class="close" data-dismiss="alert">×</button>
	</p>
	{/if}

	<form action="#form" method="post">
		<table>
			<tr>
				<th><label for="jmeno">Jméno:</label></th>
				<td><input type="text" size="32" name="jmeno" id="jmeno" value="{$smarty.post.jmeno}" /> <sup title="povinná položka">*</sup></td>
			</tr>
			<tr>
				<th><label for="adresa">Adresa:</label></th>
				<td><input type="text" size="32" name="adresa" value="{$smarty.post.adresa}" /></td>
			</tr>
			<!-- 
			<tr>
				<td><label for="mesto">Město, obec:</label></td>
				<td><input type="text" size="32" name="mesto" value="{$smarty.post.mesto}" /></td>
			</tr>
			<tr>
				<td><label for="psc">PSČ:</label></td>
				<td><input type="text" size="15" name="psc" value="{$smarty.post.psc}" /></td>
			</tr>
			-->
			<tr>
				<th><label for="telefon">Telefon:</label></th>
				<td><input type="text" size="32" name="telefon" id="telefon" value="{$smarty.post.telefon}" /></td>
			</tr>
			<tr>
				<th><label for="email">E-mail:</label></th>
				<td><input type="text" size="32" name="email" id="email" value="{$smarty.post.email}" /> <sup title="povinná položka">*</sup></td>
			</tr>	
			<tr>
				<th><label for="zprava">Váš požadavek:</label></th>
				<td><textarea rows="3" cols="30" name="zprava" id="zprava" class="form-textarea">{$smarty.post.zprava}</textarea> <sup title="povinná položka">*</sup></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="submit" class="btn btn-primary" value="Odeslat zprávu" /></td>
			</tr>
		</table>
	</form>

</section><!-- /section -->
