// settable = function (id=1,rank=1,value='store') {
//   id=id;
//   rank = rank;
//   value = value;
// }
contextmenu = function (node) {
  // console.log(value);
  // The default set of all items
  var items = {
    renameItem: {
      // The "rename" menu item
      label: "Rename",
      action: function (data) {
        var rn = $.jstree.reference(data.reference).get_node(data.reference).id;
        $.jstree.reference(data.reference).edit(rn);
        // console.log(id);
        console.log('Rename');
      },
    },
    deleteItem: {
      // The "delete" menu item
      label: "Delete",
      action: function (data) {

        if (confirm("Are you sure you wish to delete the selected item?")) {

          var rm = $.jstree.reference(data.reference).get_node(data.reference).id;
          // axios.post(`/delet_product/${rm}`).then((response) => {

          // })
        }
      },
    },
    addItem: {
      // The "delete" menu item
      label: "Add",
      action: function (data) {
        alert("Add");
        // ----------------------------------------------------------------------
        axios
          .post(`/${value}_details_node/${id}`)
          .then(function (response) {

            // console.log(response.data.details[0]);
            if (response.data.details[0].parent_id) {
              $("#parent").val(response.data.details[0].parent_id);
            } else {
              $("#parent").val(0);
            }
            // $("#parent").val(response.data.details[0].parent_id);
            $("#rank").val(response.data.details[0].rank + 1);
            console.log($("#rank").val());

            if (response.data.childs == null) {

              $(`#${value}_number`).val((id * 10) + 1);
            } else {
              $(`#${value}_number`).val(response.data.childs + 1)
            }

          })
          .catch(function (error) {
            // currentObj.output = error;
          });
        $('#exampleModal_add').modal({
          show: true
        });


      },
    },
    updateItem: {
      // The "delete" menu item
      label: "Update",
      action: function (data) {

        $('#exampleModal_update').modal({
          show: true
        });


        // ---------------------------------------------------------------------------------------------------------------

        axios.post(`/${value}/${id}`).then(function (response) {


          // console.log(response.data);
          $(`#update_${value}_number`).val(response.data.store.id);
          $(`#update_${value}`).val(response.data.store.text);
          $(`#update_parent`).val(response.data.store.parent_id);
          if (!response.data.store.parent_id) {
            $("#update_parent").val(0);
          }
          $("#update_rank").val(response.data.store.rank);

        })
          .catch(function (error) {
            // currentObj.output = error;
          });





      },
    },
  };

  if ($(node).hasClass("folder")) {
    // Delete the "delete" menu item
    delete items.deleteItem;
  }

  return items;
}

