<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Porte Monnaie</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
      integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="cash.css" />
  </head>
  <body>
    <div class="page">
      <!-- ------------------------ Début menu ------------------------------- -->
      <div class="burger-menu">
        <button id="menu-toggle">
          <i class="fa-solid fa-bars"></i>
        </button>
      </div>

      <div class="sidebar">
        <div class="close-button">
          <i class="fa-solid fa-times"></i>
        </div>

        <div class="profile-section">
          <div class="profile-picture">
            <div class="profile-icon"></div>
          </div>
        </div>

        <nav class="menu">
        <a href="control.php?action=home">
                  <div class="menu-item">
                    <div class="icon">
                      <i class="fa-solid fa-house"></i>
                    </div>
                    <div class="text">Accueil</div>
                  </div>
              </a>

          <a href="control.php?action=showSchedule">
            <div class="menu-item">
              <div class="icon timetable">
                <i class="fa-regular fa-calendar-days"></i>
              </div>
              <div class="text">Emploi du temps</div>
            </div>
          </a>

          <a href="control.php?action=showHomework">
            <div class="menu-item">
              <div class="icon text-book">
                <i class="fa-solid fa-book"></i>
              </div>
              <div class="text">Cahier de texte</div>
            </div>
          </a>

          <a href="control.php?action=showNote">
            <div class="menu-item">
              <div class="icon notes">
                <i class="fa-regular fa-newspaper"></i>
              </div>
              <div class="text">Notes</div>
            </div>
          </a>

          <a href="control.php?action=showAbsence">
            <div class="menu-item">
              <div class="icon attendance">
                <i class="fa-solid fa-graduation-cap"></i>
              </div>
              <div class="text">Absences/Retards</div>
            </div>
          </a>

          <a href="control.php?action=showChat">
            <div class="menu-item">
              <div class="icon chat">
                <i class="fa-regular fa-comments"></i>
              </div>
              <div class="text">Chat rapide</div>
            </div>
          </a>

          <a href="control.php?action=showCloud">
            <div class="menu-item">
              <div class="icon cloud">
                <i class="fa-solid fa-cloud"></i>
              </div>
              <div class="text">Cloud</div>
            </div>
          </a>

          <a href="control.php?action=showCash">
            <div class="menu-item active">
              <div class="icon wallet">
                <i class="fa-solid fa-money-check-dollar"></i>
              </div>
              <div class="text">Porte monnaie</div>
            </div>
          </a>

          <a href="control.php?action=deConnect">
            <div class="menu-item logout">
              <div class="icon">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
              </div>
              <div class="text">Déconnexion</div>
            </div>
          </a>
        </nav>
      </div>
      <!-- ------------------------ Fin menu ------------------------------- -->
      <div class="align">
        <header class="header">

        <div class="top-container">
          <div class="trait-blanc"></div>
                      <h1>Porte&nbsp;Monnaie</h1>
          <div class="trait-blanc"></div>
        </div>
        </header>
        <div class="center">
          <main class="container">
            <section class="balance-section">
              <div class="balance-card">
                <p class="balance-date">Solde au 15/11</p>
                <p class="balance-amount">10€</p>
              </div>
              <div class="qr-code">
                <img src="img/qr.png" alt="QR Code" />
              </div>
            </section>

            <section class="student-card-section">
              <h2>Ma carte étudiante</h2>
              <div class="card-details">
                <img src="img/carte.png" alt="Carte étudiante" />
                <div class="student-info">
                  <p><strong>Prénom et nom:</strong> Théo DE OLIVEIRA</p>
                  <p><strong>INE:</strong> 276289</p>
                </div>
              </div>
            </section>

            <section class="history-section">
              <div class="history-header">
                <h2>Historique</h2>
                <button class="view-all">Voir tout</button>
              </div>
              <table class="transaction-table">
                <thead>
                  <tr>
                    <th>Transaction</th>
                    <th>Coût</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Ivs France</td>
                    <td>-1,20€</td>
                    <td>15/11/2024</td>
                  </tr>
                  <tr>
                    <td>Ivs France Cormeilles En</td>
                    <td>-1,20€</td>
                    <td>10/11/2024</td>
                  </tr>
                  <tr>
                    <td>Ivs France Cormeilles En</td>
                    <td>+20€</td>
                    <td>01/11/2024</td>
                  </tr>
                </tbody>
              </table>
            </section>

            <section class="recharge-section">
              <button>Recharge par carte bancaire</button>
              <button>Recharge par virement</button>
              <button>Recharge par un tiers</button>
              <button>Recharge sur campus</button>
            </section>
          </main>
        </div>
      </div>
    </div>
    <script src="script.js"></script>
  </body>
</html>
