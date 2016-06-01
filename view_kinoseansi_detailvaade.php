<!doctype html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Kinoseansi detailvaade</title>	
        <link rel="stylesheet" type="text/css" href="kujundus.css">   
    </head>
	
    <body>
	    
		<div id="wrap">
		<h1 class="appheading">Kinoseansside piletite <br> broneerimise süsteem</h1>
		<?php foreach (message_list() as $message):?>
		    <p class="message">
			    <?= $message; ?>
			</p>
		<?php endforeach; ?>
		
		<div style="float: right">
		    <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
			    <input type="hidden" name="action" value="logout">
				<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
				
				<button type="submit">Logige välja!</button>
			</form>
		</div>
		
        <h1>Kinoseansi andmed</h1>

        <!-- Kinoseansi detailvaade -->
        <table id="kirjed" border="1">
            <th>
                <tr>
                    <th>Kinoseansi nimetus</th>
					<th>Kinoseansi toimumise aeg</th>
					<th>Vabad kohad</th>
                </tr>
            </th>
			
            <tbody>
			
			<?php $kinoseanss = model_gobooking($kinoseansi_id, $aeg); ?>
			<?php if ( !empty($kinoseanss) ) :?>
				<h3><?php echo $kinoseanss['nimetus']; ?></h3>
				<tr>
                    <td>
                        <?= htmlspecialchars($kinoseanss['nimetus']); ?>
                        </td>
						<td>
                            <?= $kinoseanss['aeg']; ?>
                        </td>
						<td>
                            <?= $kinoseanss['kohad']; ?>
                        </td>
                </tr>
			<?php endif; ?>
            
			</tbody>
        </table>
		
		<div id="lisa-broneering-vaade">
			
            <form id="lisa-broneering" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                
				<input type="hidden" name="action" value="booking">
				<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
				<input type="hidden" name="kinoseansi_id" value="<?= $kinoseanss['kinoseansi_id']; ?>">
				
				<!-- Valitud kinoseansile piletite broneerimine -->
				<h2>Broneerige pilet</h2>
				<table>
                    <tr>
                        <td>Piletite arv:</td>
					</tr>
					<tr>
                        <td>
                            <input type="number" id="piletid" name="piletid" min="1" max="1000" step="1">
                        </td>
                    </tr>
                </table>
				
				<p>
                    <button type="submit">Broneerige pilet!</button>
				</p>
				
            </form>
			
        </div>

        <script src="kino.js"></script>
		</div>
    </body>

</html>