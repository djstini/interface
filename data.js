
var datastore = [];

mainLoop();

async function mainLoop(){
    let freshData = await getData();
    addData(freshData);
    render();
    console.log(datastore);
    setTimeout(() => {
        mainLoop();
    }, 1000);
}

function addData(data){
    if(datastore.length < 20){
        datastore.push(data);
    } else {
        // rotate the array if its 20 entries long.
        datastore.shift();
        datastore.push(data);
    }
}


function getData(){
    return new Promise( (resolve) => {
        jQuery.ajax({
            url: RESTURL,
            success: function (data)  {
                console.log(data);
                resolve(data);  
            },
        });
    })
}

function render(){
    let latestData = datastore[datastore.length - 1];
    console.log(datastore);
    console.log(latestData);
    let disksTable = jQuery(".disk-table");
    let usageTable = jQuery(".usage-table");
    let temperatureTable = jQuery("temperature-table");

    jQuery(".fresh-row").remove();

    latestData.disk.forEach(element => {
        disksTable.append(
            jQuery("<tr>")
                .addClass("fresh-row")
                .append(
                    jQuery("<td>")
                        .html(element.size)
                )
                .append(
                    jQuery("<td>")
                        .html(element.used)
                )
                .append(
                    jQuery("<td>")
                        .html(element.available)
                )
                .append(
                    jQuery("<td>")
                        .html(element.percentage)
                )
        )
    });

    latestData.temps.forEach(element => {
        temperatureTable.append(
            jQuery("<tr>")
                .addClass("fresh-row")
                .append(
                    jQuery("<td>")
                        .html(element.core)
                )
                .append(
                    jQuery("<td>")
                        .html(element.temp)
                )
        )
    });

    latestData.top.forEach(element => {
        usageTable.append(
            jQuery("<tr>")
                .addClass("fresh-row")
                .append(
                    jQuery("<td>")
                        .html(element.core)
                )
                .append(
                    jQuery("<td>")
                        .html(element.usage)
                )
        )
    });
}




