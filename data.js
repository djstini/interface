
var datastore = [];
let maxDataStoreLength = 29;
mainLoop();

async function mainLoop(){
    let freshData = await getData();
    sortedData = sortData(freshData);
    addData(sortedData);
    render();
    console.log(datastore);
    setTimeout(() => {
        mainLoop();
    }, 1000);
}

function addData(data){
    if(datastore.length < maxDataStoreLength){
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

function sortData(data){
    var sortedData = data;
    sortedData.usage = data.usage.sort(function (a, b) {
        if(a.core == "all"){
            return 1;
        }
        if(b.core == "all"){
            return -1;
        }
        a.usage = parseFloat(a.usage);
        b.usage = parseFloat(b.usage);
        return b.usage - a.usage;
    });
    return sortedData;
}

function getHeighestOverallUsage(){
    heightestUsage = 0;
    datastore.forEach(function(dataset){
        allUsage = parseFloat(dataset.usage[dataset.usage.length - 1].usage);
        if( allUsage > heightestUsage){
            heightestUsage = allUsage;
        }
    });
    console.log(heightestUsage);
    return heightestUsage;
}

function render(){
    let latestData = datastore[datastore.length - 1];
    let disksTable = jQuery(".disk-table");
    let usageTable = jQuery(".usage-table");
    let temperatureTable = jQuery(".temperature-table");

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

    latestData.usage.forEach(element => {
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

    let usageGraphic = jQuery(".usage-graphic");
    usageGraphic.find("line").remove();
    usageGraphicWidth = usageGraphic.width();
    usageGraphicWidthStepsize = usageGraphicWidth / maxDataStoreLength;
    usageGraphicHeight = usageGraphic.height();
    usageGraphicHeightStepsize = usageGraphicHeight / getHeighestOverallUsage();

    let points = [];
    datastore.forEach((dataset, index) => {
        points.push({
            "x": index * usageGraphicWidthStepsize,
            "y": parseFloat(dataset.usage[dataset.usage.length - 1].usage) * usageGraphicHeightStepsize,
        });
    });
    console.log(points);
    points.forEach(function(point, index) {
        if(index != 0){
            prevPoint = points[index - 1];
        } else {
            prevPoint = {"x" : 0, "y" : 0};
        }
        
        usageGraphic.append('<line x1="' + prevPoint.x + '" y1="' + prevPoint.y + '" x2="' + point.x + '" y2="' + point.y + '" style="stroke:red;stroke-width:2"/>');
    });
}




