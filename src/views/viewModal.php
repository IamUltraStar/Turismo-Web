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
    dialog {
        width: 100%;
        height: 100vh;
        background: rgba(0, 0, 0, 0.5);
        border: none;
        outline: none;
        position: absolute;
        z-index: 2;
        top: 0;
        left: 0;
    }

    .body-dialog {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        backdrop-filter: blur(2px);
    }

    .container-dialog {
        padding: 30px 40px;
        border-radius: 8px;
        max-width: 480px;
        width: 100%;
        text-align: start;
        background-color: #fff;
        box-shadow: 0 0 5px 1px #0004;
    }

    .container-dialog h1 {
        color: #000;
    }

    .container-dialog p {
        font-size: 0.9rem;
        margin-top: 20px;
        margin-bottom: 5px;
        color: #000;
        word-wrap: break-word;
    }

    .container-dialog form {
        display: flex;
        justify-content: end;
    }

    .container-dialog button {
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

    .container-dialog button:hover {
        background-color: #212121;
    }
</style>
<script>
    document.body.style.overflow = "hidden";
    const urlModal = new URL(window.location);

    if (urlModal.searchParams.has('msg')) {
        urlModal.searchParams.delete('msg');
        window.history.replaceState({}, document.title, urlModal);
    }

    function closeDialogModal() {
        document.body.style.overflowY = "visible";
    }
</script>