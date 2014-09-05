<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pizzaria Denis</title>
        <link href="style.css" rel="stylesheet" type="text/css"/>
    </head>   
    <body>
       <div id="container">
           <div id="header">
               <div id="logo"><img src="images/logo.png" title="Pizzaria Denis" alt="Logo Pizzaria Denis" ></div><!--Logo-->
               <div id="busca">
                   <form action ="" method="POST">
                       <input type="text" name="buscar_pizza" value="buscar..."/>
                       <select name="categorias">
                           <option selected="selected">Escolha uma categoria</option>
                       </select>
                       <input type="submit" name="buscar_pizza_categoria" value="buscar">
                   </form>
               </div><!--BUSCA-->
           </div><!--Header-->
           <div id="menu">aqui vai o menu</div><!--Menu-->
           <div id="footer">Pizzaria da net <?php echo date("Y");?> - Todos os direitos reservados</div><!--Rodape-->
       </div><!--Container-->
       
    </body>
</html>
