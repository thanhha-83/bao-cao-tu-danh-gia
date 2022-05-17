<div class="modal fade" id="backupModal" tabindex="-1" role="dialog" aria-labelledby="backupModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="backupModalLabel">Xác nhận sao lưu?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">Chọn "Đồng ý" bên dưới nếu bạn muốn sao lưu báo cáo hiện tại.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-success" href="{{ route('baocao.backup') }}"
                    onclick="handleConfirmBackup(e)">
                    Đồng ý
                </a>
                <form id="backup-form" action="{{ route('baocao.backup') }}" method="POST" class="d-none">
                    @csrf
                    <input type="hidden" id="baoCao_id" name="baoCao_id">
                </form>
            </div>
        </div>
    </div>
</div>
