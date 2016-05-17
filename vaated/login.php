<form method="post" action="../i244-projekt/kontroller.php?mode=login">
   
<table class="tabel">
    <caption>Logi sisse</caption>
    <tr>
        <th>
            <label for="username-id">Kasutajanimi:</label>
        </th>
        <td>
            <input type="text" name="username" id="username-id" placeholder="Sisesta kasutajanimi">
        </td>
    </tr>
    <tr>
        <th>
            <label for="password-id">Parool:</label>
        </th>
        <td>
            <input type="password" name="password" id= "password-id" placeholder="Sisesta parool">
        </td>
    </tr>
     
        <tr>
        <td colspan="2">
            <label>
            <input type="checkbox" name="remember-me">Pea mind meeles
            </label>
        </td>
        
    </tr>
                <tr>
        <td colspan="2">
            <button type="submit">Logi sisse</button>
        </td>
        
    </tr>
   
</table>
</form>

<?php if (!empty($errors)):?>
						<?php foreach($errors as $e):?>
							<p style="color:green"><?php echo $e; ?></p>
						<?php endforeach;?>
					<?php endif;?>

