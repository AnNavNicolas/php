
<form method="post">
      <label for="lang">Lenguaje</label>
      <select name="lenguajes[]" id="lang" multiple >
        <option value="javascript">JavaScript</option>
        <option value="php">PHP</option>
        <option value="java">Java</option>
        <option value="golang">Golang</option>
        <option value="python">Python</option>
        <option value="c#">C#</option>
        <option value="C++">C++</option>
        <option value="erlang">Erlang</option>
      </select>
      <input type="submit" value="Enviar" />
</form>

<?php


if( isset( $_POST["lenguajes"] ) )
{
	foreach( $_POST["lenguajes"] as $item ) echo $item;
}