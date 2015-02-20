<?php

// Verzeichnis auslesen
if ($handle = opendir('.')) {
    while (false !== ($file = readdir($handle))) {
	    
	    // Wenn es ein Markdownfile ist, wird es verarbeitet
        if (preg_match("=(.*)\.md$=", $file, $res)) {
	        
	        // Verzeichnis für Beitrag erstellen
            $folder = $res[1];
            if(!file_exists($folder)){ mkdir( $folder ); }
            
            // MD Datei lesen
            $md = join("newline", file( $file ));
						
			// MD verarbeiten
			list( $header, $footer ) = explode( "newlinepost_type: post", $md );
			$header = explode("newline", $header);
			$content = explode("newline", $footer);

			unset($content[0]);
			unset($content[1]);
			unset($content[2]);
			unset($content[3]);			
		
			$data = array();
			foreach( $header as $line ){
				
				list( $key, $value ) = explode(": ", $line);
				
				if( $key == "post_type" ){ $is_content = true; }
				if( $key == "title" ||
					$key == "post_date" || 
					$key == "text"){
						$data[$key] = $value;		
					}
				
			}
			
			$data["headline"] = $data["title"]; 
			$data["text"] = join("\n\n", $content);

			// Neuen Content erzeugen
			$content = array();
			foreach( $data as $key=>$value ){
				array_push($content, $key . ": " . $value );
			}
			
			// neue Datei speichern
			$pfad = $folder . "/blogentry.txt";
			$content = join( "\n----\n", $content );
			file_put_contents( $pfad, $content);
			chmod( $pfad, 0775 );
			unlink($file);
        }
    }
    closedir($handle);
}	

	
?>