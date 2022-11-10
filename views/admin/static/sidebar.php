	
	<aside id="sidebar" class="column">
		<form class="quick_search">
			<input type="text" value="Hitri iskalnik" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
		</form>
		<hr/>
		<h3>Ponudbe</h3>
		<ul class="toggle">
			<li class="icn_edit_article"><a href="<?php echo base_url();?>admin/ponudbe">Pregled ponudb</a></li>
			<li class="icn_new_article"><a href="<?php echo base_url();?>admin/newoffer">Nova ponudba</a></li>
			<li class="icn_categories"><a href="<?php echo base_url();?>admin/kategorije">Kategorije</a></li>
			<li class="icn_new_article"><a href="<?php echo base_url();?>admin/newCategory">Nova kategorija</a></li>
                        <li class="icn_categories"><a href="<?php echo base_url();?>admin/tipi">Tipi ponudb</a></li>
			<li class="icn_new_article"><a href="<?php echo base_url();?>admin/newType">Nov tip</a></li>
			<li class="icn_categories"><a href="<?php echo base_url();?>admin/ponudniki">Ponudniki</a></li>
                        <li class="icn_new_article"><a href="<?php echo base_url();?>admin/newPonudnik">Nov ponudnik</a></li>
		</ul>	
		<h3>Uporabniki</h3>
		<ul class="toggle">
			<li class="icn_view_users"><a href="<?php echo base_url();?>admin/uporabniki">Poglej uporabnike</a></li>
		</ul>

                <h3>Komercialisti</h3>
		<ul class="toggle">
			<li class="icn_view_users"><a href="#">Poglej komercialiste</a></li>
			<li class="icn_profile"><a href="#">Ustvari komercialista</a></li>
		</ul>
                <h3>Vsebina</h3>
		<ul class="toggle">
			<li class="icn_new_article"><a href="#">Nova stran</a></li>
			<li class="icn_edit_article"><a href="#">Uredi stran</a></li>
		</ul>

		<h3>Admin</h3>
		<ul class="toggle">
			<li class="icn_settings"><a href="#">Nastavitve</a></li>
			<li class="icn_jump_back"><a href="<?php echo base_url();?>login/logout">Odjava</a></li>
		</ul>
		<footer>
			<hr />
			<p><strong>Vse pravice pridržane &copy; 2011 e-oglasnik</strong></p>
		</footer>
	</aside><!-- end of sidebar -->