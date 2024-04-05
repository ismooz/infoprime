var ajaxurl =
  location.protocol + "//" + location.host + "/wp-admin/admin-ajax.php";

const style = document.createElement("style");
style.type = "text/css";
style.innerHTML = `
    .copy-popup, .success-popup {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 20px;
      background-color: #4CAF50;
      color: white;
      z-index: 1001;
      border-radius: 5px;
      text-align: center;
      font-size: 18px;
    }
    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.7);
      z-index: 1000;
    }
  `;
document.head.appendChild(style);

/*document.addEventListener("DOMContentLoaded", function () {
  let deleteButtons = document.querySelectorAll('button[name="delete"]');
  deleteButtons.forEach(function (button) {});

  // Pour les boutons "Éditer", "Copier" et "Supprimer"
  document.querySelectorAll(".edit-button").forEach(addEditHandler);
  document.querySelectorAll('button[name="copy"]').forEach(addCopyHandler);
  deleteButtons.forEach(addDeleteHandler);
});*/

// Bouton éditer et sauvegarder
document.addEventListener("click", function (event) {
  const button = event.target;
  const row = button.closest("tr");
  if (!row) return; // Sortir si on n'est pas dans une ligne

  const rowId = row.getAttribute("data-id");
  const actionButtons = row.querySelector(".action-buttons");

  if (button.matches(".edit-button")) {
    // Code pour éditer
    if (actionButtons) {
      row.querySelectorAll("td[data-editable]").forEach(function (cell) {
        const input = document.createElement("input");
        input.type = "text";
        input.value = cell.textContent.trim();
        cell.innerHTML = "";
        cell.appendChild(input);
      });

      // Remplacer le bouton "Éditer" par une disquette
      const saveButton = document.createElement("button");
      saveButton.innerHTML = "💾";
      saveButton.classList.add("save-button"); // Ajouter une classe pour identification
      actionButtons.replaceChild(saveButton, button);
    }
  } else if (button.matches(".save-button")) {
    // Code pour sauvegarder
    if (actionButtons) {
      let updatedData = {};

      const editableCells = Array.from(
        row.querySelectorAll("td[data-editable]")
      );
      editableCells.forEach(function (cell) {
        const input = cell.querySelector("input"); // Recherche l'input dans la cellule
        if (input) {
          const key = cell.getAttribute("data-key");
          const table = cell.getAttribute("data-table"); // Récupérez l'attribut data-table
          if (key && table) {
            // Vérifie si 'key' et 'table' ne sont pas null
            updatedData[key] = {
              value: input.value.trim(),
              table: table, // Ajoutez l'attribut de la table
            }; // Ajoute la donnée au tableau updatedData
          }
        }
      });

      // Utilisation de fetch pour envoyer les données au serveur
      fetch(ajaxurl, {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
          action: "update_record",
          id: rowId,
          updated_data: JSON.stringify(updatedData),
        }),
      })
        .then((response) => {
          return response.json();
        })
        .then((data) => {
          console.log(data); // Affiche toutes les données retournées
          if (data.success) {
            row.querySelectorAll("td[data-editable]").forEach(function (cell) {
              const input = cell.querySelector("input");
              if (input) {
                cell.textContent = input.value.trim();
              }
            });

            // Remplacer la disquette par le bouton "Éditer"
            const editButton = document.createElement("button");
            editButton.innerHTML = "✏️";
            editButton.classList.add("edit-button");
            actionButtons.replaceChild(editButton, button);
          } else {
            alert("Échec de la mise à jour");
            // Affichez la requête SQL et les paramètres même en cas d'échec
            alert(
              "SQL Query: " +
                data.data.sql +
                "\nSQL Parameters: " +
                JSON.stringify(data.data.params)
            );
          }
        })

        .catch((error) => console.error("Erreur:", error));
    }
  }
});

// Bouton copier
function addCopyHandler(button) {
  button.addEventListener("click", function (e) {
    e.preventDefault();
    const row = button.closest("tr");
    const cells = row.querySelectorAll("td");
    let rowData = [];

    cells.forEach(function (cell, index) {
      if (index !== 0 && index !== 1) {
        rowData.push(cell.textContent);
      }
    });

    const rowString = rowData.join("\t");
    navigator.clipboard
      .writeText(rowString)
      .then(function () {
        // Créer et ajouter l'overlay
        let overlay = document.createElement("div");
        overlay.className = "overlay";
        document.body.appendChild(overlay);

        // Créer et ajouter le popup
        let popup = document.createElement("div");
        popup.className = "copy-popup";
        popup.textContent = "Copied!";
        document.body.appendChild(popup);

        // Supprimer l'overlay et le popup après 3 secondes
        setTimeout(() => {
          overlay.remove();
          popup.remove();
        }, 1000);
      })
      .catch(function (err) {
        console.error("Unable to copy text to clipboard", err);
      });
  });
}

// Bouton supprimer
function addDeleteHandler(button) {
  button.addEventListener("click", function (e) {
    e.preventDefault();
    if (confirm("Êtes-vous sûr de vouloir supprimer cet élément ?")) {
      const row = button.closest("tr");
      const id = button.value; // Assurez-vous que l'ID est bien stocké dans la valeur du bouton

      // Utilisation de fetch pour la requête AJAX
      fetch(ajaxurl, {
        // 'ajaxurl' est une variable globale définie par WordPress
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
          action: "delete_record", // le nom de l'action dans WordPress
          id: id, // l'ID à supprimer
        }),
      })
        .then((response) => response.json())
        .then((data) => {
          console.log(data); // Ajouté pour le débogage
          if (data.success) {
            row.remove();

            // Créer et ajouter l'overlay
            let overlay = document.createElement("div");
            overlay.className = "overlay";
            document.body.appendChild(overlay);

            // Affiche le message de succès
            let popup = document.createElement("div");
            popup.className = "success-popup";
            popup.textContent = "Success!"; // Utilisez le message renvoyé par la réponse JSON
            document.body.appendChild(popup);

            // Fait disparaître le popup après 3 secondes
            setTimeout(() => {
              overlay.remove();
              popup.remove();
            }, 1000);
          }
        })
        .catch((error) => console.error("Erreur:", error));
    }
  });
}

document.addEventListener("DOMContentLoaded", function () {
  let deleteButtons = document.querySelectorAll('button[name="delete"]');
  document.querySelectorAll('button[name="copy"]').forEach(addCopyHandler);
  deleteButtons.forEach(addDeleteHandler);
});

// Fonction de tri
function sortTable(n, tableId) {
  let table,
    rows,
    switching,
    i,
    x,
    y,
    shouldSwitch,
    dir,
    switchcount = 0;
  table = document.getElementById(tableId);
  switching = true;
  dir = "asc";

  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < rows.length - 1; i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("td")[n];
      y = rows[i + 1].getElementsByTagName("td")[n];
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount++;
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}

// Ajout des écouteurs d'événements pour le tri
document.addEventListener("DOMContentLoaded", function () {
  const headers = document.querySelectorAll("th");
  headers.forEach((header, index) => {
    header.addEventListener("click", function () {
      sortTable(index, "myTable");
    });
  });
});


