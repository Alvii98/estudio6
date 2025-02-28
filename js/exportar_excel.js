
function exportarExcel(name = ''){
    try {
        fetch('ajax/ajax_datos_alumnos.php', {
            method: "POST"
        })
        .then(response => response.json())
        .then(function (json) {
            console.log(json)
            let data = [],predata = [],titles = [], row = [],
            cantFamiliar = 0, cantFamAlum = 0, contfam = 0

            titles = ['APELLIDO','NOMBRE','DOCUMENTO','FECHA DE NACIMIENTO','EDAD','NACIONALIDAD','DOMICILIO',
            'LOCALIDAD','CELULAR','AUTORIZA','CORREO','SALUD','ACTIVIDADES','NOTAS','BAJAS','OBSERVACIONES']
            // console.log(titles)            
            json.resp.forEach(element => {
                row = []
                row.push(element.apellido)
                row.push(element.nombre)
                row.push(element.documento)
                row.push(formato_fecha(element.fecha_nac))
                row.push(element.edad)
                row.push(element.nacionalidad)
                row.push(element.domicilio)
                row.push(element.localidad)
                row.push(element.tel_movil)
                row.push(element.autoriza)
                row.push(element.mail)
                row.push(element.salud)
                row.push(element.actividad)
                row.push(element.notas)
                row.push(element.baja)
                row.push(element.observaciones)
                cantFamAlum = 0
                json.resp2.forEach(element2 => {
                    if (element.id == element2.id_alumno) {
                        cantFamAlum++
                        row.push(element2.nombre_apellido)
                        row.push(element2.telefono)                        
                        row.push(element2.vinculo)                        
                        row.push(element2.observacion)                        
                    }
                })
                if (cantFamAlum > cantFamiliar) {
                    if (cantFamiliar > 0) contfam = cantFamAlum - cantFamiliar
                    else contfam = cantFamAlum

                    for (let i = 0; i < contfam; i++) {
                        titles.push(['NOMBRE Y APELLIDO'],['TELEFONO'],['VINCULO'],['OBSERVACION'])
                    }   
                    cantFamiliar = cantFamAlum
                }
                predata.push(row)
            })

            data.push(titles)

            predata.forEach(element => {
                data.push(element)
            });
            // (C2) CREATE NEW EXCEL "FILE"
            let workbook = XLSX.utils.book_new(),
            worksheet = XLSX.utils.aoa_to_sheet(data);
            // ANCHO DE COLUMNAS
            var wscols = [
                { wch: 20 },
                { wch: 20 },
                { wch: 10 },
                { wch: 12 }, 
                { wch: 5 }, 
                { wch: 12 }, 
                { wch: 20 },
                { wch: 20 }, 
                { wch: 15 }, 
                { wch: 15 }, 
                { wch: 20 },
                { wch: 10 }, 
                { wch: 100 },
                { wch: 100 }, 
                { wch: 5 }, 
                { wch: 100 },
                { wch: 30 },
                { wch: 15 },
                { wch: 10 },
                { wch: 100 },
                { wch: 30 },
                { wch: 15 },
                { wch: 10 },
                { wch: 100 },
                { wch: 30 },
                { wch: 15 },
                { wch: 10 },
                { wch: 100 },
                { wch: 30 },
                { wch: 15 },
                { wch: 10 },
                { wch: 100 }
            ];
            worksheet['!cols'] = wscols;
            workbook.SheetNames.push("First");
            workbook.Sheets["First"] = worksheet;
        
            // (C3) TO BINARY STRING
            let xlsbin = XLSX.write(workbook, {
            bookType: "xlsx",
            type: "binary"
            });
        
            // (C4) TO BLOB OBJECT
            let buffer = new ArrayBuffer(xlsbin.length),
                array = new Uint8Array(buffer);
            for (let i = 0; i < xlsbin.length; i++) {
            array[i] = xlsbin.charCodeAt(i) & 0XFF;
            }
            let xlsblob = new Blob([buffer], {type:"application/octet-stream"});
        
            // (C5) "FORCE DOWNLOAD"
            let url = window.URL.createObjectURL(xlsblob),
            anchor = document.createElement("a");
            anchor.href = url;
            anchor.download = "datos_"+name+".xlsx";
            anchor.click();
            window.URL.revokeObjectURL(url);
        })
        .catch(function (error){
            console.log(error)
            // Catch errors
            alertify.alert('Datos del alumno/a','Ocurrio un error vuelve a intentar.')
            return false
        })
    
    } catch (error) {
        console.log(error)
        alertify.alert('Datos del alumno/a','Ocurrio un error vuelve a intentar.')
    }
}

function formato_fecha(fecha) {
    fecha = fecha.split('-')
    // console.log(fecha[2]+'/'+fecha[1]+'/'+fecha[0])
    return fecha[2]+'/'+fecha[1]+'/'+fecha[0]
}


function exportarExcelActividad(id_tabla){
    try {
        if(id_tabla.trim() == '') return alert('No esta el nombre de la tabla.')

        let tabla = document.querySelector('#'+id_tabla),
        nom_actividad = document.querySelector('#nom_actividad').textContent
        
        let th,
        tr = tabla.childNodes[3].getElementsByTagName("tr"),
        data = [],titles = [], row = [],principal = []

        try {
            th = tabla.childNodes[1].childNodes[3].getElementsByTagName("th")
        } catch (error) {
            th = tabla.childNodes[1].childNodes[1].getElementsByTagName("th")
        }

        for (let i = 0; i < th.length; i++) {
            if (principal.length == 0) principal.push(nom_actividad)
            else principal.push('')
            titles.push(th[i].innerText.toUpperCase());
        }
        data.push(principal)
        data.push(titles)
        let valor = ''
        for (let e = 0; e < tr.length; e++) {
            if(tr[e].style.display == "none") continue;
            row = []
            for (let d = 0; d < tr[e].getElementsByTagName("td").length; d++) {
                valor = tr[e].getElementsByTagName("td")[d].innerText
                if(valor.indexOf(",") > -1 && !/[a-zA-Z]/.test(valor)){
                    valor = parseFloat(valor.replace(/\./g, "").replace(",","."))
                }
                row.push(valor)
            }
            data.push(row)
        }

        // (C2) CREATE NEW EXCEL "FILE"
        let workbook = XLSX.utils.book_new(),
        worksheet = XLSX.utils.aoa_to_sheet(data);
        workbook.SheetNames.push("First");
        workbook.Sheets["First"] = worksheet;
    
        // (C3) TO BINARY STRING
        let xlsbin = XLSX.write(workbook, {
        bookType: "xlsx",
        type: "binary"
        });
    
        // (C4) TO BLOB OBJECT
        let buffer = new ArrayBuffer(xlsbin.length),
            array = new Uint8Array(buffer);
        for (let i = 0; i < xlsbin.length; i++) {
        array[i] = xlsbin.charCodeAt(i) & 0XFF;
        }
        let xlsblob = new Blob([buffer], {type:"application/octet-stream"});
    
        // (C5) "FORCE DOWNLOAD"
        let url = window.URL.createObjectURL(xlsblob),
        anchor = document.createElement("a");
        anchor.href = url;
        anchor.download = "actividad_alumnos.xlsx";
        anchor.click();
        window.URL.revokeObjectURL(url);
    } catch (error) {
        console.log(error)
        alert('No se encontro tabla.')
    }
}
