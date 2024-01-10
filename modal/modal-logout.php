<div class="modal fade" id="modal-logout">
    <div class="modal-dialog">
        <div class="modal-content loginform">
            <div class="modal-header1">
                <p class="txt-title">Bạn muốn đăng xuất ?</p>
                <div class="wrapper-button">
                    <button type="button" class="btn btn-primary " onclick="confirmLogout()">OK</button>
                    <button type="button" class="btn btn-danger" onclick="closeModal()">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .txt-title{
        font-size: 18px;
    }
    .wrapper-button{
        display: flex;
    }
    .wrapper-button button{
        margin-left: 5px;
        padding : 5px 20px ;
    }
</style>
<script>
    function confirmLogout() {
        window.location.href = 'pages/main/logout.php';
    }
    function closeModal() {
        $('#modal-logout').modal('hide');
    }
    
</script>
