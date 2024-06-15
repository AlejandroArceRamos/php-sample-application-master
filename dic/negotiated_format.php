<?php

/**
 * Returns the best negotiated format according to RFC 7231.
 */

// Función para obtener el formato negociado
function getBestFormat($acceptHeader) {
    // Analizar el encabezado Accept
    $acceptHeader = explode(',', $acceptHeader);

    // Comprobar si se prefiere JSON
    if (in_array('application/json', $acceptHeader)) {
        return 'application/json';
    }

    // Si no se prefiere JSON, se asume HTML
    return 'text/html';
}

// Obtener el formato negociado basado en el encabezado Accept del cliente
return getBestFormat($_SERVER["HTTP_ACCEPT"]);
