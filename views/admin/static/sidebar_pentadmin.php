	
	<aside id="sidebar" class="column">
            <form class="quick_search" action="<?php echo base_url();?>admin/search" method="post">
			<input type="text" name="term" value="Hitri iskalnik" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
                        <select name="type"><option value="users"> Uporabniki </option>
                        <option value="ponudbe"> Ponudbe </option>
                        <option value="partnerji"> Partnerji </option>
                        <option value="komercialisti"> Komercialisti </option>
                        <option value="vsebine"> Vsebine </option>
                        </select>   
                        <input type="submit" value="Najdi">
		</form>
		<hr/>
		<h3>Ponudbe</h3>
		<ul class="toggle">
			<li class="icn_edit_article"><a class="<?=($this->uri->segment(2, 0)=== 'ponudbe')?'current':''?>" href="<?php echo base_url();?>admin/ponudbe">Pregled vseh ponudb</a></li>
			<li class="icn_edit_article"><a class="<?=($this->uri->segment(2, 0)=== 'trenutnePonudbe')?'current':''?>" href="<?php echo base_url();?>admin/trenutnePonudbe">Pregled trenutnih ponudb</a></li>
			<li class="icn_edit_article"><a class="<?=($this->uri->segment(2, 0)=== 'preteklePonudbe')?'current':''?>" href="<?php echo base_url();?>admin/preteklePonudbe">Pregled preteklih ponudb</a></li>
			<li class="icn_new_article"><a class="<?=($this->uri->segment(2, 0)=== 'newoffer')?'current':''?>" href="<?php echo base_url();?>admin/newoffer">Nova ponudba</a></li>
			<li class="icn_categories"><a target="_blank" href="<?php echo base_url();?>admin/blankOffer">Prazna naročilnica</a></li>
			<li class="icn_categories"><a class="<?=($this->uri->segment(2, 0)=== 'komentarji')?'current':''?>" href="<?php echo base_url();?>admin/komentarji">Komentarji ponudb</a></li>
			<li class="icn_categories"><a class="<?=($this->uri->segment(2, 0)=== 'kategorije')?'current':''?>" href="<?php echo base_url();?>admin/kategorije">Kategorije</a></li>
			<li class="icn_new_article"><a class="<?=($this->uri->segment(2, 0)=== 'newCategory')?'current':''?>" href="<?php echo base_url();?>admin/newCategory">Nova kategorija</a></li>
                        <li class="icn_categories"><a class="<?=($this->uri->segment(2, 0)=== 'tipi')?'current':''?>" href="<?php echo base_url();?>admin/tipi">Tipi ponudb</a></li>
			<li class="icn_new_article"><a class="<?=($this->uri->segment(2, 0)=== 'newType')?'current':''?>" href="<?php echo base_url();?>admin/newType">Nov tip</a></li>
		</ul>	
                <h3>Nakupi</h3>
		<ul class="toggle">
			<li class="icn_categories"><a class="<?=($this->uri->segment(2, 0)=== 'listnakupi')?'current':''?>" href="<?php echo base_url();?>admin/listnakupi">Pregled vseh nakupov</a></li>
			<li class="icn_categories"><a class="<?=($this->uri->segment(2, 0)=== 'listkuponi')?'current':''?>" href="<?php echo base_url();?>admin/listkuponi">Pregled vseh kuponov</a></li>
		</ul>
                <h3>Partnerji</h3>
                <ul class="toggle">
			<li class="icn_categories"><a class="<?=($this->uri->segment(2, 0)=== 'ponudniki')?'current':''?>" href="<?php echo base_url();?>admin/ponudniki">Partnerji</a></li>
                        <li class="icn_new_article"><a class="<?=($this->uri->segment(2, 0)=== 'newPonudnik')?'current':''?>" href="<?php echo base_url();?>admin/newPonudnik">Nov partner</a></li>
                        <li class="icn_new_article"><a target="_blank" href="<?php echo base_url();?>uploads-ponudbe/partner.pdf">Nov partner - PDF</a></li>
			<li class="icn_categories"><a class="<?=($this->uri->segment(2, 0)=== 'pogodba')?'current':''?>" href="<?php echo base_url();?>admin/pogodba">Nova pogodba</a></li>
			<li class="icn_categories"><a class="<?=($this->uri->segment(2, 0)=== 'pogodbe')?'current':''?>" href="<?php echo base_url();?>admin/pogodbe">Pregled pogodb</a></li>

                </ul>
		<h3>Uporabniki</h3>
		<ul class="toggle">
			<li class="icn_view_users"><a class="<?=($this->uri->segment(2, 0)=== 'uporabniki')?'current':''?>" href="<?php echo base_url();?>admin/uporabniki">Poglej uporabnike</a></li>
			<li class="icn_view_users"><a class="<?=($this->uri->segment(2, 0)=== 'uporabnikiAdd')?'current':''?>" href="<?php echo base_url();?>admin/uporabnikAdd">Dodaj uporabnika</a></li>
		</ul>
                
                <h3>Komercialisti</h3>
		<ul class="toggle">
			<li class="icn_view_users"><a class="<?=($this->uri->segment(2, 0)=== 'komers')?'current':''?>" href="<?php echo base_url();?>admin/komers">Poglej komercialiste</a></li>
			<li class="icn_profile"><a class="<?=($this->uri->segment(2, 0)=== 'newKomer')?'current':''?>" href="<?php echo base_url();?>admin/newKomer">Ustvari komercialista</a></li>
			<li class="icn_categories"><a class="<?=($this->uri->segment(2, 0)=== 'statKomer')?'current':''?>" href="<?php echo base_url();?>admin/statKomer">Poglej statistiko komercialista</a></li>

		</ul>
                <h3>Oglasi</h3>
                <ul class="toggle">
			<li class="icn_categories"><a class="<?=($this->uri->segment(2, 0)=== 'oglasi')?'current':''?>" href="<?php echo base_url();?>admin/oglasi">Oglasi</a></li>
                        <li class="icn_new_article"><a class="<?=($this->uri->segment(2, 0)=== 'newOglas')?'current':''?>" href="<?php echo base_url();?>admin/newOglas">Nov oglas</a></li>
                </ul>
                <h3>Vsebina</h3>
		<ul class="toggle">
			<li class="icn_categories"><a class="<?=($this->uri->segment(2, 0)=== 'content')?'current':''?>" href="<?php echo base_url();?>admin/content">Pregled strani</a></li>
			<li class="icn_new_article"><a class="<?=($this->uri->segment(2, 0)=== 'newContent')?'current':''?>" href="<?php echo base_url();?>admin/newContent">Nova stran</a></li>
			<li class="icn_new_article"><a class="<?=($this->uri->segment(2, 0)=== 'kolofon')?'current':''?>" href="<?php echo base_url();?>admin/kolofon">Uredi kolofon</a></li>
		</ul>
                <h3>Blog</h3>
		<ul class="toggle">
			<li class="icn_categories"><a class="<?=($this->uri->segment(2, 0)=== 'blog')?'current':''?>" href="<?php echo base_url();?>admin/blog">Pregled objav</a></li>
			<li class="icn_new_article"><a class="<?=($this->uri->segment(2, 0)=== 'newBlog')?'current':''?>" href="<?php echo base_url();?>admin/newBlog">Nova objava</a></li>
		</ul>  
                <h3>Statistika</h3>
		<ul class="toggle">
			<li class="icn_categories"><a class="<?=($this->uri->segment(2, 0)=== 'stats')?'current':''?>" href="<?php echo base_url();?>admin/stats">Statistika obiskov</a></li>
		</ul>  
                <h3>Zapisnik strežnika</h3>
		<ul class="toggle">
			<li class="icn_categories"><a class="<?=($this->uri->segment(2, 0)=== 'log')?'current':''?>" href="<?php echo base_url();?>admin/log">Poglej zapisnik</a></li>
		</ul>
                <h3>Admin</h3>
		<ul class="toggle">
			<li class="icn_categories"><a href="<?php echo base_url();?>login/logout">Odjava</a></li>
		</ul>

		<footer>
			<hr />
			<p><strong>Vse pravice pridržane &copy; 2012 e-oglasnik</strong></p>
		</footer>
	</aside><!-- end of sidebar -->