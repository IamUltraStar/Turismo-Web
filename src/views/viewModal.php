<dialog id="dialog-modal" open>
    <div class='body-dialog'>
        <div class='container-dialog'>
            <h1 id="title-modal"><?php echo $titleModal; ?></h1>
            <p id="msg-modal"><?php echo $msgModal; ?></p>
            <form method='dialog'>
                <button onclick="closeDialogModal()">Ok</button>
            </form>
        </div>
    </div>
</dialog>
<style>
    #dialog-modal {
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

    #dialog-modal .body-dialog {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        backdrop-filter: blur(2px);
    }

    #dialog-modal .container-dialog {
        padding: 30px 40px;
        border-radius: 8px;
        max-width: 480px;
        width: 100%;
        text-align: start;
        background-color: #fff;
        box-shadow: 0 0 5px 1px #0004;
        max-height: 90%;
        overflow-y: auto;
    }

    #dialog-modal .container-dialog h1 {
        color: #000;
    }

    #dialog-modal .container-dialog p {
        font-size: 0.9rem;
        margin-top: 20px;
        margin-bottom: 5px;
        color: #000;
        word-wrap: break-word;
    }

    #dialog-modal .container-dialog form {
        display: flex;
        justify-content: end;
    }

    #dialog-modal .container-dialog button {
        color: #fff;
        font-weight: bold;
        width: 30%;
        cursor: pointer;
        margin-top: 15px;
        padding: 10px 20px;
        background-color: #000;
        border: 0;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    #dialog-modal .container-dialog button:hover {
        background-color: #212121;
    }
</style>
<script>
    document.body.style.overflow = "hidden";

    function closeDialogModal() {
        document.body.style.overflowY = "visible";
    }
</script>