<dialog id="dialog-profile-modal" open>
    <div class='body-dialog'>
        <div class='container-dialog'>
            <h1 class="title-modal">Mi Perfil</h1>
            <form action="<?= base_url("profile/update") ?>" method="POST">
                <div class="row-input-dialog">
                    <label for="fullname">Nombres</label>
                    <input type="text" name="fullname" value="<?php echo $userData['FullName']; ?>" required>
                </div>
                <div class="row-input-dialog">
                    <label for="username">Nombre de usuario</label>
                    <input type="text" value="<?php echo $userData['Username']; ?>" disabled>
                </div>
                <div class="row-input-dialog">
                    <label for="email">Email</label>
                    <input type="email" value="<?php echo $userData['Email']; ?>" disabled>
                </div>
                <h1>Actualizar contraseña</h1>
                <div class="row-input-dialog">
                    <label for="password">Contraseña Actual</label>
                    <input type="password" name="password">
                </div>
                <div class="row-input-dialog">
                    <label for="new_password">Nueva Contraseña</label>
                    <input type="password" name="new_password">
                </div>
                <div class="row-input-dialog">
                    <label for="confirm_password">Confirmar Nueva Contraseña</label>
                    <input type="password" name="confirm_password">
                </div>
                <div class="actions-form">
                    <a href="<?= base_url() ?>">Cancelar</a>
                    <button type="submit">Listo</button>
                </div>
            </form>
        </div>
    </div>
</dialog>
<style>
    #dialog-profile-modal {
        width: 100%;
        height: 100vh;
        background: rgba(0, 0, 0, 0.5);
        border: none;
        outline: none;
        position: absolute;
        z-index: 10;
        top: 0;
        left: 0;
    }

    #dialog-profile-modal .body-dialog {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        backdrop-filter: blur(2px);
    }

    #dialog-profile-modal .container-dialog {
        background-color: #fff;
        padding: 2rem;
        padding-top: 1.35rem;
        border-radius: 0.5rem;
        height: 90%;
        overflow-y: auto;
    }

    #dialog-profile-modal .title-modal {
        margin-bottom: 0.5rem;
    }

    #dialog-profile-modal form {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    #dialog-profile-modal form h1 {
        margin-top: 1rem;
    }

    #dialog-profile-modal .row-input-dialog {
        display: flex;
        flex-direction: column;
    }

    #dialog-profile-modal .row-input-dialog label {
        font-size: 1rem;
        margin-bottom: 0.125rem;
        color: #000;
    }

    #dialog-profile-modal .row-input-dialog input {
        padding: 10px 8px;
        border-radius: 0.5rem;
        border: 1px solid #000;
        box-shadow: 0 0 4px #0000008a;
    }

    #dialog-profile-modal .row-input-dialog input:focus {
        outline: none;
    }

    #dialog-profile-modal .actions-form {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }

    #dialog-profile-modal .actions-form a {
        text-decoration: none;
        color: #000;
        padding: 8px 15px;
        border-radius: 0.5rem;
        transition: background-color 0.3s ease;
    }

    #dialog-profile-modal .actions-form a:hover {
        background-color: #ddd;
    }

    #dialog-profile-modal .actions-form button {
        background-color: #000;
        color: #fff;
        border: none;
        padding: 8px 35px;
        border-radius: 0.5rem;
        cursor: pointer;
        box-shadow: 0 0 4px #0000008a;
        transition: opacity 0.3s ease;
    }

    #dialog-profile-modal .actions-form button:hover {
        opacity: 0.8;
    }

    @media (height > 750px) {
        #dialog-profile-modal .container-dialog {
            height: auto;
        }
    }
</style>
<script>
    document.body.style.overflow = "hidden";
</script>