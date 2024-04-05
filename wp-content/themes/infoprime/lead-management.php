<?php
// Gestion des demandes

function enqueue_custom_admin_styles()
{
    wp_enqueue_style('custom-admin-styles', get_stylesheet_directory_uri() . '/custom-styles.css', array(), '1.0.0', 'all');
}
add_action('admin_enqueue_scripts', 'enqueue_custom_admin_styles');



function enqueue_custom_admin_script()
{
    if (is_admin()) {
        wp_enqueue_script('my-custom-admin-script', get_stylesheet_directory_uri() . '/custom-admin.js', array('jquery'), '1.0', true);
    }
}
add_action('admin_enqueue_scripts', 'enqueue_custom_admin_script');


// Connexion à la base de données des offres
function get_db_connection()
{
    return new PDO('mysql:host=mysql.economies.ch;dbname=medt_WP14675', 'medt_ismael', 'IsmaeL_1983');
}

function add_my_custom_menu()
{
    add_menu_page(
        'Gestion des Leads', // Titre de la page
        'Gestion des Leads', // Titre du menu
        'manage_options', // Capabilité
        'gestion_leads', // Slug du menu
        'my_custom_menu_page', // Fonction pour afficher le contenu
        'dashicons-admin-generic', // Icône
        6  // Position dans le menu
    );
}
add_action('admin_menu', 'add_my_custom_menu');

function my_custom_menu_page()
{
    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">';
    echo '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">';

    $db = get_db_connection();
    //$query = $db->query('SELECT offres.*, personnes.nom, personnes.prenom, personnes.naissance, personnes.tel, personnes.adresse, personnes.adresseNo, personnes.npa, personnes.localite, personnes.franchise , divisions.nom AS divisionNom, offres.ip FROM offres INNER JOIN personnes ON offres.id = personnes.offreId INNER JOIN divisions ON offres.divisionId = divisions.id');
    $query = $db->query('SELECT offres.*, personnes.nom, personnes.prenom, personnes.naissance, personnes.tel, personnes.adresse, personnes.adresseNo, personnes.npa, personnes.localite, personnes.franchise, divisions.nom AS divisionNom, offres.ip FROM offres INNER JOIN personnes ON offres.id = personnes.offreId INNER JOIN divisions ON offres.divisionId = divisions.id ORDER BY offres.dateCreation DESC');
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    /*if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'delete') {
        $id = $_POST['id'];
        $stmt = $db->prepare("DELETE FROM offres WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "failed";
        }
        exit();
    }*/

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete' && !empty($_POST['selected'])) {
        $db = get_db_connection();
        foreach ($_POST['selected'] as $id) {
            $id = intval($id);
            $stmt = $db->prepare("DELETE FROM offres WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if (!$stmt->execute()) {
                // Gérer l'erreur ici, par exemple avec error_log
                error_log("Échec de la suppression de l'enregistrement avec ID $id");
            }
        }
        echo "<script>window.location.href = window.location.href;</script>";
    }

    echo '<h1>Gestion des Offres</h1>';

    // Formulaire pour les actions en batch
    echo '<form id="action-form" method="post" action="">';
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("action-form");
            form.addEventListener("submit", function(event) {
                const action = form.querySelector("select[name=\'action\']").value;
                if (action === "delete") {
                    const confirmed = confirm("Êtes-vous sûr de vouloir supprimer cet élément ?");
                    if (!confirmed) {
                        event.preventDefault();
                    }
                }
            });
        });
    </script>';
    echo '<div class="d-flex align-items-center mb-3">'; // Container flex pour aligner les éléments
    echo '<select name="action" class="form-select me-3">'; // 'form-select' pour Bootstrap et 'me-3' pour l'espacement
    echo '<option value="delete">Supprimer</option>';
    echo '<option value="update">Mettre à jour</option>';
    echo '</select>';
    echo '<input type="submit" value="Appliquer" class="btn btn-primary"/>'; // 'btn btn-primary' pour le style Bootstrap
    echo '</div>';

    //echo '<div class="table-responsive" style="overflow: auto; width: 100%; margin: 1em; width: 95%;">';
    //echo '<table id="myTable" class="wp-list-table widefat fixed datatable table table-striped table-bordered">';
    echo '<div class="table-responsive">';
    echo '<table id="myTable" class="table table-striped table-hover table-bordered" style="width:100%">';
    echo '<thead>';
    echo '<tr>';
    //echo '<th><input type="checkbox" id="selectall" /></th>'; // Case à cocher pour tout sélectionner
    echo '<th class="text-nowrap"></th>'; // Case à cocher pour tout sélectionner
    echo '<th class="text-nowrap">Actions</th>';
    echo '<th class="text-nowrap">N°</th>'; // ID de la demande
    echo '<th class="text-nowrap">Nom</th>';
    echo '<th class="text-nowrap">Prénom</th>';
    echo '<th class="text-nowrap">Né(e) en</th>';
    echo '<th class="text-nowrap">Tél</th>';
    echo '<th class="text-nowrap">Rue et n°</th>';
    echo '<th class="text-nowrap">NPA</th>';
    echo '<th class="text-nowrap">Localité</th>';
    echo '<th class="text-nowrap">Assureur actuel</th>';
    echo '<th class="text-nowrap">Nouvel assureur</th>';
    echo '<th class="text-nowrap">Modèle</th>';
    echo '<th class="text-nowrap">Division</th>';
    echo '<th class="text-nowrap">Franchise</th>';
    echo '<th class="text-nowrap">Prime</th>';
    echo '<th class="text-nowrap">Date demande</th>';
    echo '<th class="text-nowrap">Ip</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    $counter = 0;
    foreach ($results as $row) {
        $counter++;
        //$rowColor = ($counter % 2 == 0) ? '#DDD' : '#FFF';
        //echo '<tr data-id="' . esc_attr($row->id) . '" style="background-color:' . $rowColor . ';">';
        echo '<tr data-id="' . esc_attr($row->id) . '">';
        echo '<td class="text-nowrap"><input type="checkbox" name="selected[]" value="' . esc_html($row->id) . '"></td>'; // Case à cocher pour chaque enregistrement
        echo '<td style="white-space: nowrap; margin-right: 1em;">'; // Empêche le retour à la ligne des éléments
        echo '<div class="action-buttons">'; // Ajout d'un conteneur pour les boutons
        echo '<button type="submit" name="edit" class="edit-button" value="' . esc_html($row->id) . '" style="background: none; border: none; cursor: pointer;">✏️</button>';
        echo '<button type="submit" name="copy" value="' . esc_html($row->id) . '" style="background: none; border: none; cursor: pointer;">📄</button>';
        echo '<button type="submit" name="delete" value="' . esc_html($row->id) . '" style="background: none; border: none; cursor: pointer;");">❌</button>';
        echo '</div>'; // Fermeture du conteneur pour les boutons
        echo '</td>';
        /*echo '<td style="white-space: nowrap; margin-right: 0.5em;">'; // Empêche le retour à la ligne des éléments
        echo '<div class="action-buttons"><button class="edit-button" style="background: none; border: none; cursor: pointer;">✏️</button><button class="copy-button" style="background: none; border: none; cursor: pointer;">📄</button><button class="delete-button" style="background: none; border: none; cursor: pointer;" >❌</button></div>';
        echo '</td>';*/
        echo '<td class="text-nowrap" data-key="id">' . esc_html($row->id) . '</td>'; // ID de la demande
        echo '<td class="text-nowrap" data-editable data-key="nom" data-table="personnes">' . esc_html($row->nom) . '</td>';
        echo '<td class="text-nowrap" data-editable data-key="prenom" data-table="personnes">' . esc_html($row->prenom) . '</td>';
        echo '<td class="text-nowrap" data-editable data-key="naissance" data-table="personnes">' . esc_html($row->naissance) . '</td>';
        echo '<td class="text-nowrap" data-editable data-key="tel" data-table="personnes">' . esc_html($row->tel) . '</td>';
        echo '<td class="text-nowrap" data-editable data-key="adresse" data-table="personnes">' . esc_html($row->adresse) . ' ' . esc_html($row->adresseNo) . '</td>';
        echo '<td class="text-nowrap" data-editable data-key="npa" data-table="personnes">' . esc_html($row->npa) . '</td>';
        echo '<td class="text-nowrap" data-editable data-key="localite" data-table="personnes">' . esc_html($row->localite) . '</td>';
        echo '<td class="text-nowrap" data-key="assureurId">' . esc_html($row->assureurId) . '</td>';
        echo '<td class="text-nowrap" data-key="assureurOffreId">' . esc_html($row->assureurOffreId) . '</td>';
        echo '<td class="text-nowrap" data-key="model">' . esc_html($row->tarifType) . '</td>';
        echo '<td class="text-nowrap" data-key="division">' . esc_html($row->divisionNom) . '</td>';
        echo '<td class="text-nowrap" data-key="franchise">' . esc_html($row->franchise) . '</td>';
        echo '<td class="text-nowrap" data-key="primeNouvelleOffre">' . esc_html($row->primeNouvelleOffre) . '</td>';
        echo '<td class="text-nowrap" data-key="dateCreation">' . esc_html($row->dateCreation) . '</td>';
        echo '<td class="text-nowrap" data-key="ip">' . esc_html($row->ip) . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';

    echo '</form>';
    echo '</div>';
    // Fin du formulaire
    echo '<script>
        jQuery(document).ready(function($) {
            $("#myTable").DataTable({
                "lengthMenu": [[25, 50, 100], [25, 50, 100]],
                "pageLength": 25
            });
        });
      </script>';

}

function delete_record()
{
    $db = get_db_connection();
    $id = intval($_POST['id']); // Récupère l'ID du POST AJAX

    // Votre logique de suppression ici
    $stmt = $db->prepare("DELETE FROM offres WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        wp_send_json_success('Enregistrement supprimé avec succès.');
    } else {
        wp_send_json_error('Échec de la suppression de l\'enregistrement.');
    }

    wp_die(); // Ce-ci est requis pour terminer correctement la requête AJAX
}

add_action('wp_ajax_delete_record', 'delete_record');


function update_record()
{
    $db = get_db_connection();
    $id = intval($_POST['id']);
    $updated_data = json_decode(stripslashes($_POST['updated_data']), true);
    error_log(print_r($_POST, true));

    // Parcourir chaque élément dans updated_data
    foreach ($updated_data as $key => $data) {
        $value = $data['value'];
        $table = $data['table'];

        $sql = "UPDATE $table SET $key = :value WHERE offreId = :id";  // Assurez-vous que le WHERE correspond à votre logique
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':id', $id);

        if (!$stmt->execute()) {
            wp_send_json_error(array('message' => 'Échec de la mise à jour de l\'enregistrement.'));
            wp_die();
        }
    }

    wp_send_json_success(array('message' => 'Enregistrement mis à jour avec succès.'));
    wp_die();
}

add_action('wp_ajax_update_record', 'update_record');
