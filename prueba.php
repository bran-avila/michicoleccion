
  <?php
  include_once 'php/conexion.php';
        $errorInsertpedido=false;
        $sql="insert into detalle_producto(idpedido,idproducto,cantidad,precio,subtotal,nombre) 
        values(:idpedido,:idproducto,:cantidad,:precio,:subtotal,:nombre)";
        $sql= connect()->prepare($sql);
        $sql->bindValue(':idpedido','1');
        $sql->bindValue(':idproducto','1');
        $sql->bindValue(':cantidad',"2");
        $sql->bindValue(':precio',"280.99");
        $sql->bindValue(':subtotal',"460.80");
        $sql->bindValue(':nombre',"gdsgsdhsdh");
        if( $sql->execute()){
            $errorInserttipoPago= true;
        }else{
            $errorInserttipoPago=  false;
        }
  
  
  ?>