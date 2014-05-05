<?php if(!$this->request('skip')){ ?>
	<h2 class="title green">Escuelas en donde está este programa. (Ciclo escolar: 2013/2014)</h2>
<?php } ?>
        <div class="white-box map">
            <table>
                <?php foreach($this->escuelas as $escuela){ ?>
                <tr>
                    <td><?=$this->capitalize($escuela->nombre)." | ".$this->capitalize($escuela->nivel->nombre)." | ".$this->capitalize($escuela->turno->nombre)." | ".$this->capitalize($escuela->municipio->nombre)." | CCT ".$escuela->cct ?></td>
                    <td><a href="/escuelas/index/<?= $escuela->cct ?>" class="button-frame"><span class="button">Ver escuela</span></a></td>
                    <div class="clear"></div>
                </tr>
                <?php }?>
</table>
<a class="more_cct" href="?<?=$this->url_more_cct?>">
	Ver más
</a>
</div>
