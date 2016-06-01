<!doctype html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Piletite broneerimine</title>
		
        <style>
            #lisa-vorm-vaade {
                display: none;
                border: 1px solid red;
                padding: 10px;
            }		
        </style>	  
    </head>
	
    <body>
	    
		<?php foreach (message_list() as $message):?>
		    <p style="border: 1px solid blue; background: #EEE;">
			    <?= $message; ?>
			</p>
		<?php endforeach; ?>
		
		<div style="float: right">
		    <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
			    <input type="hidden" name="action" value="logout">
				<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
				<button type="submit">Logi välja</button>
			</form>
		</div>
		
        <h1>Piletite broneerimine</h1>
		
        <p>
		    <button type="button" id="kuva-lisa-vorm">Ava kinoseansside sisestamise vorm</button>
		</p>

        <div id="lisa-vorm-vaade">
			
            <form id="lisa-vorm" method="post" action="<?= $_SERVER['PHP_SELF']; ?>"> 
                
				<input type="hidden" name="action" value="add">
				<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
				
				<p>
				    <button type="button" id="peida-lisa-vorm">Peida kinoseansside sisestamise vorm</button>
				</p>
				
				<h2>Lisa kinoseanss kinokavasse</h2>
				
				<table>
                    <tr>
                        <td>Filmi nimetus</td>
                        <td>
                            <input type="text" id="nimetus" name="nimetus">
                        </td>
                    </tr>
					<tr>
                        <td>Kinoseansi algusaeg</td>
                        <td>
                            <input type="datetime-local" id="aeg" name="aeg">
                        </td>
                    </tr>
                    <tr>
                        <td>Kohtade arv</td>
                        <td>
                            <input type="number" id="kohad" name="kohad">
                        </td>
                    </tr>
                </table>
				
				<p>
                    <button type="submit" id="lisa-nupp">Lisa kinoseanss</button>
				</p>
				
            </form>
			
        </div>
		
        <table id="kirjed" border="1">
            <thead>
                <tr>
                    <th>Filmi nimetus</th>
					<th>Kinoseansi toimumise aeg</th>
					<th>Vabad kohad</th>
                    <th>Broneerimine</th>
                    <th>Kustuta kinoseanss</th>
                </tr>
            </thead>
			
            <tbody>
			
            <?php 
                foreach ( model_load($page) as $rida ): ?>
                    <tr>
                        <td>
                            <?= htmlspecialchars($rida['nimetus']); ?>
                        </td>
						<td>
                            <?= $rida['aeg']; ?>
                        </td>
						<td>
                            <?= $rida['kohad']; ?>
                        </td>
						<td>
						    <form method="get" action="<?= $_SERVER['PHP_SELF']; ?>">
							
							    <input type="hidden" name="action" value="gobooking">
                                <input type="hidden" name="kinoseansi_id" value="<?= $rida['kinoseansi_id']; ?>">
								<input type="hidden" name="aeg" value="<?= $rida['aeg']; ?>">
                                
								<button type="submit">Pileti broneerimine</button>
                                
							</form>
							
                        </td>
                        <td>
					
                            <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
							    <input type="hidden" name="action" value="delete">
								<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                                <input type="hidden" name="kinoseansi_id" value="<?= $rida['kinoseansi_id']; ?>">
								
                                <button type="submit">Kustuta kinoseanss</button>
                            </form>
                    
                        </td>
                    </tr>
            <?php endforeach; ?>
            
			</tbody>
        </table>
		
		<p>
		    <a href="<?= $_SERVER['PHP_SELF']; ?>?page=<?= $page - 1; ?>">
			    Eelmine lehekülg
			</a>
			|
			<a href="<?= $_SERVER['PHP_SELF']; ?>?page=<?= $page + 1; ?>">
			    Järgmine lehekülg
			</a>
			
		</p>

        <script src="kino.js"></script>
    </body>

</html>
