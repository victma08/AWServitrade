<?php
//Clase encargada de actualizar la información del objeto Usuario en la BBDD
class UsuarioDAO {
 . . . 
 public inserta(Usuario $p) {
 // No insertamos el id, se supone que lo genera automáticamente la BBDD 
 $query("INSERT into Usuarios (nombre,apellidos,num_doc) values 
 (" . $p->nombre . "," . $p->apellidos . "," . $p->num_doc . ")");
 . . . 
 }
 public update(Usuario $p) {
 $query("UPDATE Usuarios (nombre,apellidos,num_doc) values 
 ('" . $p->nombre . "','" . $p->apellidos . "','" . 
 $p->num_doc . "') where id = '" . $p->id . "'");
 . . .  }
 
public delete(Usuario $p) {
 $query("DELETE Usuarios where id = '" . $p->id . "'");
 . . . 
 }
public Usuario getUsuario($id) {
 $filas = SelectArray("SELECT * from Usuarios where id = '$id'");
 $fila = $filas[0];
 $p = new Usuario();
 $p->nombre = $fila['nombre'];
 $p->apellidos = $fila['apellidos'];
 $p->num_doc = $fila['num_doc'];
 $p->id = $fila['id'];
 return $p;
 }
}
?>

<?php
$p = new Usuario();
$p->nombre = "LUIS";
$p->apellidos = "PEREZ MARTINEZ";
$p->num_doc = "11111111";
/* Ya tenemos el usuario creado */
$usuarioDAO = new UsuarioDAO();
/* Ahora hemos creado la clase encargada de manipular los datos */
$usuarioDAO->insert($p);
/* Insertamos el usuario en la BBDD */
?>

<?php
$usuarioDAO = new UsuarioDAO();
$p = $usuarioDAO->getUsuario(23);
/* Recuperamos el Usuario con el identificador 23 */$usuarioDAO->delete($p);
/* Borramos el Usuario recuperado */
?>
Para MODIFICAR un Usuario de la BBDD:
<?php
$usuarioDAO = new UsuarioDAO();
$p = $usuarioDAO->getUsuario(23);
/* Recuperamos el Usuario con el identificador 23 */
$p->nombre = "BENITO";
/* Cambiamos el nombre */
$usuarioDAO->update($p);
/* Guardamos las modificaciones en la BBDD */
?>
