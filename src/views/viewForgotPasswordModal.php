<dialog id="dialog-forgot-password-modal" open>
    <div class='body-dialog'>
        <div class='container-dialog'>
            <h1 class="title-modal">Has olvidado tu contraseña</h1>
            <form action="<?= base_url(path: "login/send-reset-link") ?>" method="POST">
                <div class="row-input-dialog">
                    <label for="email">Correo Electronico</label>
                    <input type="email" name="email" placeholder="example@domain.com" required autofocus>
                </div>
                <div class="actions-form">
                    <a href="<?= base_url("login") ?>">Cancelar</a>
                    <button type="submit">Enviar correo</button>
                </div>
            </form>
        </div>
    </div>
</dialog>
<style>
    #dialog-forgot-password-modal {
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

    #dialog-forgot-password-modal .body-dialog {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        backdrop-filter: blur(2px);
    }

    #dialog-forgot-password-modal .container-dialog {
        background-color: #fff;
        padding: 2rem;
        padding-top: 1.35rem;
        border-radius: 0.5rem;
        overflow-y: auto;
    }

    #dialog-forgot-password-modal .title-modal {
        margin-bottom: 0.5rem;
        color: #000;
    }

    #dialog-forgot-password-modal form {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    #dialog-forgot-password-modal .row-input-dialog {
        display: flex;
        flex-direction: column;
    }

    #dialog-forgot-password-modal .row-input-dialog label {
        font-size: 1rem;
        margin-bottom: 0.125rem;
        color: #000;
    }

    #dialog-forgot-password-modal .row-input-dialog input {
        padding: 10px 8px;
        border-radius: 0.5rem;
        border: 1px solid #000;
        box-shadow: 0 0 4px #0000008a;
        color: #000;
    }

    #dialog-forgot-password-modal .row-input-dialog input:focus {
        outline: none;
    }

    #dialog-forgot-password-modal .actions-form {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }

    #dialog-forgot-password-modal .actions-form a {
        text-decoration: none;
        color: #000;
        padding: 10px 15px;
        border-radius: 0.5rem;
        transition: background-color 0.3s ease;
    }

    #dialog-forgot-password-modal .actions-form a:hover {
        background-color: #ddd;
    }

    #dialog-forgot-password-modal .actions-form button {
        background-color: #000;
        color: #fff;
        border: none;
        padding: 10px 25px;
        border-radius: 0.5rem;
        cursor: pointer;
        box-shadow: 0 0 4px #0000008a;
        transition: opacity 0.3s ease;
    }

    #dialog-forgot-password-modal .actions-form button:hover {
        opacity: 0.8;
    }
</style>
<script>
    document.body.style.overflow = "hidden";
</script>