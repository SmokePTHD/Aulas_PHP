<!DOCTYPE html>
<html>
  <head>
    <title>Início</title>
  </head>
  <?php
  session_start();
  require_once 'header.php';

  $loggedin = isset($_SESSION['utilizador']) || isset($_COOKIE['utilizador']);
  $utilizador = $loggedin ? ($_SESSION['utilizador'] ?? $_COOKIE['utilizador']) : '';

  $background_style = isset($_COOKIE['aceitou_cookies']) ? "" : "background: rgba(0, 0, 0, 0.2)";
  ?>
  <body style="<?php echo $background_style; ?>">
    <div class='center'>Bem-vindo a gpsi22,
      <?php echo $loggedin ? "$utilizador, você está ligado." : "por favor registe-se ou entre."; ?>
    </div>
    <br>
    <div data-role="footer" style="position: fixed; bottom: 0; width: 100%; text-align: center;">
      <h4><i><a href='http://www.epb.pt' target='_blank'>Rede social da turma de gpsi22</a></i></h4>
    </div>

    <?php if (!isset($_COOKIE['aceitou_cookies'])): ?>
      <div id="cookie-banner" style="position: fixed; bottom: 0; left: 0; width: 100%; background: #eee; color: #000; padding: 15px; text-align: center;">
        Este site utiliza cookies para melhorar a experiência do utilizador. 
        <button onclick="aceitarCookies()">Aceitar</button>
      </div>
      <script>
        function aceitarCookies() {
            document.cookie = "aceitou_cookies=true; path=/; max-age=" + (60 * 60 * 24 * 365);
            document.getElementById("cookie-banner").style.display = "none";
        }
      </script>
    <?php endif; ?>
  </body>
</html>
