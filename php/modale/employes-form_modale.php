<div class="modal-container y-scroll scroll" aria-modal="false" tabindex="-1" role="dialog">
<div class="container mt-4 form-box">
        <div class="message_container"></div>
        <form method="post" enctype="multipart/form-data">
            <div id="fieldset-container">
                <!-- Groupe d'informations personnelles -->
                <div class="fieldset-container fieldset1">
                    <h3 class="">Formulaire d'ajout d'employés</h3>
                    <fieldset>
                        <legend>Informations personnelles</legend>
                        <div class="form-row">
                            <div class="image-container">
                                <input required type="file" class="form-control" id="photo" name="files">
                                <!-- <label for="photo">Photo</label> -->
                                <div class="big">
                                    <div class=" ">
                                        <label for="nom_employe">Nom</label>
                                        <input required type="text" class="form-control" id="nom_employe" name="nom_employe">
                                    </div>
                                    <div class=" ">
                                        <label for="prenom_employe">Prénom</label>
                                        <input required type="text" class="form-control" id="prenom_employe" name="prenom_employe">
                                    </div>
                                    <div class=" ">
                                        <label for="date_de_naissance">Date de naissance</label>
                                        <input required type="date" class="form-control" id="date_de_naissance" name="date_de_naissance">
                                    </div>
                                </div>
                                <label class="image-user" for="photo">
                                    <img src="" alt="" class="upload-img">
                                    <svg class="upload-icon" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 1024 1024">
                                        <path fill="currentColor" d="M544 864V672h128L512 480L352 672h128v192H320v-1.6c-5.376.32-10.496 1.6-16 1.6A240 240 0 0 1 64 624c0-123.136 93.12-223.488 212.608-237.248A239.808 239.808 0 0 1 512 192a239.872 239.872 0 0 1 235.456 194.752c119.488 13.76 212.48 114.112 212.48 237.248a240 240 0 0 1-240 240c-5.376 0-10.56-1.28-16-1.6v1.6H544z" />
                                    </svg>
                                </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class=" ">
                                <label for="nationalite">Nationalité</label>
                                <input required type="text" class="form-control" id="nationalite" name="nationalite">
                            </div>
                        </div>
                        <div class="">
                            <label for="sexe">Sexe</label>
                            <select required class="form-control" id="sexe" name="sexe">
                                <option value="M">Maxulin</option>
                                <option value="F">Feminin</option>
                                <!-- <option value="autre">Autre</option> -->
                            </select>
                        </div>
                        <div class="">
                            <label for="numero_securite_sociale">Numéro de sécurité sociale</label>
                            <input type="text" class="form-control" id="numero_securite_sociale" name="numero_securite_sociale">
                        </div>
                    </fieldset>
                    <button type="button" class="btn btn-primary next1">Suivant</button>
                </div>

                <!-- Groupe d'informations professionnelles -->
                <div class="fieldset-container fieldset2">
                <h1>Formulaire de gestion des employés</h1>
                    <fieldset>
                        <legend>Informations professionnelles</legend>
                        <div class="form-row">
                            <div class=" ">
                                <label for="date_embauche">Date d'embauche</label>
                                <input required type="date" class="form-control" id="date_embauche" name="date_embauche">
                            </div>
                            <div class=" ">
                                <label for="date_de_depart">Date de départ</label>
                                <input required type="date" class="form-control" id="date_de_depart" name="date_de_depart">
                            </div>
                        </div>
                        <div class="">
                            <label for="poste_occupe">Poste occupé</label>
                            <select required class="form-control" id="poste_occupe" name="poste_occupe">
                                <?php foreach ($jobs as $job) : ?>
                                    <option value="<?= $job['id']; ?>"><?= $job['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <div class="">
                            <label for="statut">Statut</label>
                            <select required class="form-control" id="statut" name="statut">
                                <option value="cdd">Contrat à durée déterminé (CDD)</option>
                                <option value="cdi">Contrat à durée indéterminé (CDI)</option>
                            </select>
                        </div>
                        <div class="">
                            <label for="salaire">Salaire</label>
                            <input required type="number" class="form-control" id="salaire" name="salaire">
                        </div>
                    </fieldset>
                    <div class="btn-container">
                        <button type="button" class="btn btn-primary prev1">Précédent</button>
                        <button required type="button" class="btn btn-primary next2">Suivant</button>
                    </div>


                </div>


                <div class="fieldset-container fieldset3">
                <h1>Formulaire de gestion des employés</h1>
                    <fieldset>
                        <legend>Coordonnées</legend>
                        <div class="">
                            <label for="tel">Téléphone</label>
                            <input required type="tel" class="form-control" id="tel" name="tel">
                        </div>
                        <div class="">
                            <label for="adresse">Adresse</label>
                            <input required type="text" class="form-control" id="adresse" name="adresse">
                        </div>
                        <div class="">
                            <label for="email">Email</label>
                            <input required type="email" class="form-control" id="email" name="email">
                        </div>
                    </fieldset>
                    <div class="btn-container">
                        <button type="button" class="btn btn-primary prev2">Précédent</button>
                        <button required type="submit" class="btn btn-primary save">Enregistrer</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>