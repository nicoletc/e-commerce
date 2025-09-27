$(function(){
  const $tbody = $('#tbody');

  function escapeHtml(s){return String(s).replace(/[&<>"']/g,m=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]))}

  function load(){
    $.getJSON('../Actions/fetch_category_action.php', res=>{
      if(res.status!=='success') return Swal.fire({icon:'error',title:'Fetch failed',text:res.message||'Unable to load.'});
      if(!res.data || !res.data.length) return $tbody.html('<tr><td colspan="2">No categories yet.</td></tr>');
      $tbody.html(res.data.map(r=>`
        <tr data-id="${r.cat_id}">
          <td>
            <span data-view>${escapeHtml(r.cat_name)}</span>
            <input data-edit class="input" type="text" value="${escapeHtml(r.cat_name)}" style="display:none" maxlength="100">
          </td>
          <td class="actions">
            <button class="btn btn--alt" data-act="edit">Edit</button>
            <button class="btn" data-act="save" style="display:none">Save</button>
            <button class="btn" data-act="del">Delete</button>
          </td>
        </tr>`).join(''));
    }).fail(()=>Swal.fire({icon:'error',title:'Error',text:'Request failed'}));
  }

  // CREATE
  $('#create-form').on('submit', e=>{
    e.preventDefault();
    const name = $('#cat_name').val().trim();
    if(!/^[A-Za-z0-9\s\-&,.'()]{2,100}$/.test(name))
      return Swal.fire({icon:'error',title:'Invalid name',text:'2–100 chars; letters, numbers, spaces, basic punctuation.'});
    $.ajax({
      url:'../Actions/add_category_action.php', type:'POST', dataType:'json', contentType:'application/json',
      data: JSON.stringify({cat_name:name}),
      success: res=>{
        if(res.status==='success'){ $('#cat_name').val(''); Swal.fire({icon:'success',title:'Created',timer:900,showConfirmButton:false}); load(); }
        else Swal.fire({icon:'error',title:'Create failed',text:res.message||'Try again.'});
      }, error:()=>Swal.fire({icon:'error',title:'Error',text:'Request failed'})
    });
  });

  // EDIT / SAVE / DELETE
  $tbody.on('click','[data-act]', function(){
    const $tr=$(this).closest('tr'); const id=Number($tr.data('id')); const act=$(this).data('act');
    if(act==='edit'){ $tr.find('[data-view]').hide(); $tr.find('[data-edit]').show().focus();
      $tr.find('[data-act="edit"]').hide(); $tr.find('[data-act="save"]').show(); return; }
    if(act==='save'){
      const name=$tr.find('[data-edit]').val().trim();
      if(!/^[A-Za-z0-9\s\-&,.'()]{2,100}$/.test(name))
        return Swal.fire({icon:'error',title:'Invalid name',text:'2–100 chars.'});
      $.ajax({
        url:'../Actions/update_category_action.php', type:'POST', dataType:'json', contentType:'application/json',
        data: JSON.stringify({cat_id:id, cat_name:name}),
        success: res=>{
          if(res.status==='success'){ Swal.fire({icon:'success',title:'Updated',timer:900,showConfirmButton:false}); load(); }
          else Swal.fire({icon:'error',title:'Update failed',text:res.message||'Try again.'});
        }, error:()=>Swal.fire({icon:'error',title:'Error',text:'Request failed'})
      });
      return;
    }
    if(act==='del'){
      Swal.fire({icon:'warning',title:'Delete this category?',showCancelButton:true,confirmButtonText:'Delete'})
      .then(r=>{
        if(!r.isConfirmed) return;
        $.ajax({
          url:'../Actions/delete_category_action.php', type:'POST', dataType:'json', contentType:'application/json',
          data: JSON.stringify({cat_id:id}),
          success: res=>{
            if(res.status==='success'){ Swal.fire({icon:'success',title:'Deleted',timer:900,showConfirmButton:false}); load(); }
            else Swal.fire({icon:'error',title:'Delete failed',text:res.message||'Try again.'});
          }, error:()=>Swal.fire({icon:'error',title:'Error',text:'Request failed'})
        });
      });
    }
  });

  load();
});
