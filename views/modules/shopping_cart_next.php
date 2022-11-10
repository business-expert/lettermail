<div id="main" role="main" class="roundedCorners5">
            <div id="wrapper">
                <div id="steps">
                    <form id="formElem" name="formElem" action="<?php echo base_url();?>shopping/finish" method="post">
                        <fieldset class="step" id="step0">

                            <legend>Osebni podatki kupca</legend>
                            <input type="hidden" name="pay_user" value="<?php echo $user_status->user_id;?>">
                            <p>
                                <label for="username">Ime</label>
                                <input id="username" class="capitalize" value="<?php echo $user_status->user_name;?>" name="user_name" />
                            </p>     
                            <p>
                                <label for="username">Priimek</label>
                                <input id="username" class="capitalize" value="<?php echo $user_status->user_surname;?>" name="user_surname" />
                            </p>     
                            <p>
                                <label for="username">Email</label>
                                <input id="username" value="<?php echo $user_status->user_email;?>" name="user_email" />
                            </p>  
                            <p>
                                <label for="username">Telefonska številka</label>
                                <input id="username" value="<?php echo $user_status->user_phone;?>" name="user_phone" />
                            </p>                    
                            <p>
                                <label for="username">Naslov</label>
                                <input id="username" class="capitalize" value="<?php echo $user_status->user_address;?>" name="user_address" />
                            </p>              
                            <p>
                                <label for="username">Pošta</label>
                                <input id="username" value="<?php echo $user_status->user_zip;?>" name="user_zip" />
                            </p>           
                            <p>
                                <label for="username">Kraj</label>
                                <input id="username" class="capitalize" value="<?php echo $user_status->user_city;?>"  name="user_city" />
                            </p>
                            
                        </fieldset>        
                        <fieldset class="step" id="step1">

                            <legend>Osebni podatki porabnika kupona</legend>
                            <p>
                                <label for="username">Ime</label>
                                <input id="username" class="capitalize" value="<?php echo $user_status->user_name;?>" name="rec_name" />
                            </p>     
                            <p>
                                <label for="username">Priimek</label>
                                <input id="username" class="capitalize" value="<?php echo $user_status->user_surname;?>" name="rec_surname" />
                            </p>     
                            <p>
                                <label for="username">Email</label>
                                <input id="username" value="<?php echo $user_status->user_email;?>" name="rec_email" />
                            </p>  
                            <p>
                                <label for="username">Telefonska številka</label>
                                <input id="username" value="<?php echo $user_status->user_phone;?>" name="rec_phone" />
                            </p>                    
                            <p>
                                <label for="username">Naslov</label>
                                <input id="username" class="capitalize" value="<?php echo $user_status->user_address;?>" name="rec_address" />
                            </p>              
                            <p>
                                <label for="username">Pošta</label>
                                <input id="username" value="<?php echo $user_status->user_zip;?>" name="rec_zip" />
                            </p>           
                            <p>
                                <label for="username">Kraj</label>
                                <input id="username" class="capitalize" value="<?php echo $user_status->user_city;?>"  name="rec_city" />
                            </p>
                        </fieldset>

                        <fieldset class="step" id="step2">
                            <legend>Plačilo</legend>

                            <p>
                                <label for="cardtype">Način plačila</label>
                                <input type="radio" name="pay_option" selected="selected" value="upn" class="pp" checked="checked"/> UPN Nalog<br/>
                                <input type="radio" name="pay_option" value="creditcard" class="pp" /> Kreditna kartica<br/></li>
                            </p> 
                        </fieldset>

			<fieldset class="step" id="step3">
                            <legend>Potrditev</legend>
							<p>

Neko končno sporočilo za uporabnika itd,.. Preverite da imajo vsa spodnja polja zeleno oznako. Le tako lahko potrdite svoj nakup.
							</p>
                            <p class="submit">
                                <button id="registerButton" class="nakupDone" type="submit">NAKUP</button>
                            </p>
                        </fieldset>
                    </form>
                </div>
                <div id="navigation_steps" style="display:none;">

                    <ul>
                        <li class="selected">
                            <a href="#">Osebni podatki</a>
                        </li>

                        <li>

                            <a href="#">Porabnik kupona</a>
                        </li>    
                        
                        <li>

                            <a href="#">Plačilo</a>
                        </li>

			<li>
                            <a href="#">Potrditev</a>

                        </li>
                    </ul>
                </div>
            </div>
</div>
