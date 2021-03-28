<!DOCTYPE html>
<html>
    <head>
    <title>Görev Güncellemesi Yapıldı!</title>
    <meta charset="utf-8" />
   </head>
<body>
<div class='container-fluid'>
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>Görev Güncellemesi Yapıldı!</h3>
            </div>
            <p>Sayın <b>{{ $user->name }},</b> 
            <b>{{ date('d.m.Y H:i',strtotime($task->created_at)) }}</b> tarihinde <b>{{ $task->header }}</b> 
            başlıklı görev {{ $authUser->name }} tarafından güncelleme yapıldı.</p>
            <p>Görev bitiş tarihi <b>{{ date('d.m.Y',strtotime($task->end_date))}}</b> dir.</p>
        </div>
    </div>
</div>
</body>
</html>