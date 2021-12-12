
    function desactivarCuenta(id_to_delete) {
        var confirmation = confirm('Esta seguro que desea desactivar: ' + id_to_delete + ' ?');
        if (confirmation) {
            window.location = "<?= BASE_URL ?>admin/d?x=" + id_to_delete;
        }
    }

    function activarCuenta(id_to_delete) {
        var confirmation = confirm('Esta seguro que desea activar: ' + id_to_delete + ' ?');
        if (confirmation) {
            window.location = "<?= BASE_URL ?>admin/a?x=" + id_to_delete;
        }
    }
