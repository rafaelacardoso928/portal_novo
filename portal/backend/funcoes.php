<?php

function proteger($valor)
{
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}

function resumo($texto)
{
    return substr($texto, 0, 120) . "...";
}
