<?php
namespace Modelo;
require_once "conexion.php";

class File
{
    public function getAll()
    {
        global $db;
        $sql = $db->query("SELECT * FROM files");
        return $sql->fetch_all(MYSQLI_ASSOC);
    }

    

    public function create($data)
    {
        global $db;
        $title = $data['title'];
        $description = $data['description'];
        $url = $data['url'];
        $query = "INSERT INTO files VALUES(null, '$title', '$description', '$url')";
        $sql = $db->query($query);
        return $sql;
    }
    
}