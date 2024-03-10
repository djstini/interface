
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
    let usageGraphicWidth = usageGraphic.width();
    let usageGraphicWidthStepsize = usageGraphicWidth / maxDataStoreLength;
    let usageGraphicHeight = usageGraphic.height();
    let heightesOverallUsage = getHeighestOverallUsage();
    let usageGraphicHeightStepsize = usageGraphicHeight / heightesOverallUsage;

    let points = [];
    datastore.forEach((dataset, index) => {
        points.push({
            "x": index * usageGraphicWidthStepsize,
            "y": parseFloat(dataset.usage[dataset.usage.length - 1].usage) * usageGraphicHeightStepsize,
        });
    });
    
    points.forEach(function(point, index) {
        if(index != 0){
            prevPoint = points[index - 1];
        } else {
            return;
        }
        
        console.log("draw");
        console.log(point);
        console.log(prevPoint);
        var newLine = document.createElementNS('http://www.w3.org/2000/svg','line');
        newLine.setAttribute('id','line');
        newLine.setAttribute('x1',prevPoint.x);
        newLine.setAttribute('y1',prevPoint.y);
        newLine.setAttribute('x2',point.x);
        newLine.setAttribute('y2',point.y);
        newLine.setAttribute("stroke", "#613583")
        newLine.setAttribute("stroke-width", "2")
        usageGraphic.append(newLine);
    });

    jQuery(".svg-usage-label").remove();
    let usageSvgLabelContainer = jQuery(".usage-svg-labels");
    let labelHeight = usageSvgLabelContainer.height() / 5;
    for( i = 5; i >= 0; i--){
        usageSvgLabelContainer.append(
            jQuery("<span>").addClass("svg-usage-label").height(labelHeight).text(Math.round(heightesOverallUsage * 100 ) / 100 / 5 * i + "px")
        )
    }
}




