/**
 * Created by Daan on 12-6-15.
 */
;

/**
 * @global
 * @namespace
 */
var tabLinks = new Array();
var contentDivs = new Array();
var keyboard = {
    /**
     * @private
     * @type {*[]}
     */
    categories: ["emoticons","nature","objects","places","other"],
    data: {
        "other": ["0023-20E3", "0031-20E3", "0032-20E3", "0033-20E3", "0034-20E3", "0036-20E3", "0037-20E3", "0038-20E3", "0039-20E3", "0030-20E3", "1F51F", "1F522", "1F523", "2B06", "2B07", "2B05", "27A1", "1F520", "1F521", "1F524", "1F504", "1F53C", "1F53D", "2935", "2934", "1F197", "1F500", "1F501", "1F195", "1F199", "1F192", "1F193", "1F4F6", "1F3A6", "1F201", "1F22F", "1F233", "1F235", "1F234", "1F232", "1F250", "1F239", "1F23A", "1F236", "1F21A", "1F6BB", "1F6B9", "1F6BA", "1F6BC", "1F6BE", "1F6B0", "1F6AE", "1F17F", "267F", "1F6AD", "1F237", "1F238", "1F6C2", "1F6C4", "1F6C5", "1F6C3", "1F251", "3299", "3297", "1F198", "1F6AB", "1F51E", "1F6AF", "1F6B1", "1F6B3", "1F6B7", "1F6B8", "26D4", "2733", "2747", "274E", "2705", "2734", "1F49F", "1F19A", "1F4F3", "1F4F4", "1F170", "1F18E", "1F17E", "1F4A0", "27BF", "267B", "2648", "2649", "264A", "264B", "264C", "264D", "264E", "264F", "2650", "2651", "2652", "2653", "26CE", "1F52F", "1F3E7", "1F4B9", "1F4B2", "1F4B1", "303D", "3030", "1F51D", "1F51A", "1F519", "1F51B", "274C", "2B55", "2757", "2753", "2755", "2754", "1F503", "1F55B", "1F567", "1F550", "1F55C", "1F55D", "1F552", "1F55E", "1F553", "1F55F", "1F554", "1F560", "1F555", "1F556", "1F557", "1F558", "1F559", "1F55A", "1F561", "1F562", "1F563", "1F564", "1F565", "1F566", "2795", "2796", "2797", "2660", "2665", "2663", "2666", "1F4AE", "2714", "1F518", "1F517", "27B0", "1F531", "1F532", "1F533", "1F53A", "2B1C", "2B1B", "26AB", "26AA", "1F534", "1F535", "1F53B", "1F536", "1F537", "1F538", "1F539", "1F4BF", "1F202", "1F4FA", "1F191", "1F194", "1F196"],
        "objects": ["1F38D", "1F49D", "1F38E", "1F392", "1F393", "1F38F", "1F386", "1F387", "1F390", "1F391", "1F383", "1F47B", "1F385", "1F384", "1F381", "1F38B", "1F389", "1F38A", "1F388", "1F38C", "1F52E", "1F3A5", "1F4F7", "1F4F9", "1F4FC", "1F4C0", "1F4BD", "1F4BE", "1F4BB", "1F4F1", "1F4DE", "1F4DF", "1F4E0", "1F4E1", "1F4FB", "1F50A", "1F509", "1F508", "1F507", "1F514", "1F515", "1F4E2", "1F4E3", "1F513", "1F512", "1F50F", "1F510", "1F511", "1F50E", "1F4A1", "1F526", "1F506", "1F505", "1F50C", "1F50B", "1F50D", "1F6C1", "1F6C0", "1F6BF", "1F6BD", "1F527", "1F529", "1F528", "1F6AA", "1F6AC", "1F4A3", "1F52B", "1F52A", "1F48A", "1F489", "1F4B0", "1F4B4", "1F4B5", "1F4B7", "1F4B6", "1F4B3", "1F4B8", "1F4F2", "1F4E7", "1F4E5", "1F4E4", "2709", "1F4E9", "1F4E8", "1F4EF", "1F4EB", "1F4EA", "1F4EC", "1F4ED", "1F4EE", "1F4E6", "1F4DD", "1F4C4", "1F4C3", "1F4D1", "1F4CA", "1F4C8", "1F4C9", "1F4DC", "1F4CB", "1F4C5", "1F4C6", "1F4C7", "1F4C1", "1F4C2", "2702", "1F4CC", "1F4CE", "2712", "270F", "1F4CF", "1F4D0", "1F4D5", "1F4D7", "1F4D8", "1F4D9", "1F4D3", "1F4D4", "1F4DA", "1F4D6", "1F516", "1F4DB", "1F52C", "1F52D", "1F4F0", "1F3A8", "1F3A4", "1F3A7", "1F3BC", "1F3B5", "1F3B6", "1F3B9", "1F3BB", "1F3BA", "1F3B7", "1F3B8", "1F47E", "1F3AE", "1F0CF", "1F3B4", "1F004", "1F3B2", "1F3AF", "1F3C8", "1F3C0", "26BD", "26BE", "1F3BE", "1F3B1", "1F3C9", "1F3B3", "26F3", "1F6B5", "1F6B4", "1F3C1", "1F3C7", "1F3BF", "1F3C2", "1F3CA", "1F3C4", "1F3A3", "2615", "1F375", "1F376", "1F37C", "1F37A", "1F37B", "1F378", "1F379", "1F377", "1F374", "1F355", "1F354", "1F35F", "1F357", "1F356", "1F35D", "1F35B", "1F364", "1F371", "1F363", "1F365", "1F359", "1F358", "1F35A", "1F372", "1F362", "1F361", "1F373", "1F35E", "1F369", "1F36E", "1F366", "1F368", "1F367", "1F370", "1F36A", "1F36B", "1F36C", "1F36D", "1F36F", "1F34E", "1F34F", "1F34A", "1F34B", "1F352", "1F347", "1F349", "1F353", "1F351", "1F348", "1F34C", "1F350", "1F34D", "1F360", "1F346", "1F345", "1F33D"],
        "emoticons": ["1F604", "1F603", "1F600", "1F60A", "263A", "1F609", "1F60D", "1F618", "1F61A", "1F617", "1F619", "1F61C", "1F61D", "1F61B", "1F633", "1F601", "1F614", "1F60C", "1F612", "1F61E", "1F623", "1F622", "1F602", "1F62D", "1F625", "1F630", "1F605", "1F613", "1F629", "1F62B", "1F628", "1F631", "1F620", "1F621", "1F624", "1F616", "1F606", "1F60B", "1F637", "1F60E", "1F634", "1F635", "1F632", "1F61F", "1F626", "1F627", "1F608", "1F47F", "1F62E", "1F62C", "1F610", "1F615", "1F62F", "1F636", "1F60F", "1F611", "1F472", "1F473", "1F46E", "1F477", "1F482", "1F476", "1F466", "1F467", "1F468", "1F469", "1F474", "1F475", "1F471", "1F47C", "1F478", "1F63A", "1F638", "1F63B", "1F63D", "1F63C", "1F640", "1F63F", "1F639", "1F63E", "1F479", "1F47A", "1F648", "1F649", "1F64A", "1F480", "1F47D", "1F4A9", "1F525", "2728", "1F31F", "1F4AB", "1F4A5", "1F4A2", "1F4A6", "1F4A7", "1F4A4", "1F4A8", "1F442", "1F440", "1F443", "1F445", "1F444", "1F44D", "1F44E", "1F44C", "1F44A", "270A", "270C", "1F44B", "270B", "1F446", "1F447", "1F449", "1F448", "1F64C", "1F64F", "261D", "1F44F", "1F4AA", "1F6B6", "1F3C3", "1F483", "1F46B", "1F46A", "1F46C", "1F46D", "1F48F", "1F46F", "1F646", "1F645", "1F481", "1F64B", "1F486", "1F487", "1F485", "1F470", "1F64E", "1F64D", "1F3A9", "1F451", "1F452", "1F45F", "1F45E", "1F461", "1F460", "1F462", "1F455", "1F454", "1F45A", "1F457", "1F3BD", "1F456", "1F458", "1F459", "1F4BC", "1F45C", "1F45D", "1F45B", "1F453", "1F380", "1F302", "1F484", "1F49B", "1F499", "1F49C", "1F49A", "2764", "1F494", "1F497", "1F493", "1F495", "1F496", "1F49E", "1F498", "1F48C", "1F48B", "1F48D", "1F48E", "1F464", "1F465", "1F4AC", "1F463", "1F4AD", "1F469-200D-1F469-200D-1F466", "1F469-200D-1F469-200D-1F466-200D-1F466", "1F468-200D-2764-FE0F-200D-1F48B-200D-1F468", "1F469-200D-1F469-200D-1F467", "1F469-200D-2764-FE0F-200D-1F469", "1F469-200D-2764-FE0F-200D-1F48B-200D-1F469", "1F468-200D-2764-FE0F-200D-1F468", "1F469-200D-1F469-200D-1F467-200D-1F467", "1F469-200D-1F469-200D-1F467-200D-1F466", "1F468-200D-1F468-200D-1F466-200D-1F466", "1F468-200D-1F468-200D-1F467-200D-1F466", "1F468-200D-1F468-200D-1F467", "1F468-200D-1F468-200D-1F466", "1F468-200D-1F468-200D-1F467-200D-1F467", "1F468-200D-1F469-200D-1F466", "1F468-200D-1F469-200D-1F467-200D-1F466", "1F468-200D-1F469-200D-1F467", "1F468-200D-1F469-200D-1F466-200D-1F466", "1F468-200D-1F469-200D-1F467-200D-1F467"],
        "places": ["1F3E0", "1F3E1", "1F3EB", "1F3E2", "1F3E3", "1F3E5", "1F3E6", "1F3EA", "1F3E9", "1F3E8", "1F492", "26EA", "1F3EC", "1F3E4", "1F307", "1F3EF", "1F3F0", "26FA", "1F3ED", "1F5FC", "1F5FE", "1F5FB", "1F304", "1F305", "1F303", "1F5FD", "1F309", "1F3A0", "1F3A1", "26F2", "1F3A2", "1F6A2", "26F5", "1F6A4", "1F6A3", "2693", "1F680", "2708", "1F4BA", "1F681", "1F682", "1F68A", "1F689", "1F69E", "1F686", "1F684", "1F685", "1F688", "1F687", "1F69D", "1F68B", "1F683", "1F68E", "1F68C", "1F68D", "1F699", "1F698", "1F697", "1F695", "1F696", "1F69B", "1F69A", "1F6A8", "1F693", "1F694", "1F692", "1F691", "1F690", "1F6B2", "1F6A1", "1F6A0", "1F69C", "1F488", "1F68F", "1F3AB", "1F6A6", "1F6A5", "26A0", "1F6A7", "1F530", "26FD", "1F3EE", "1F3B0", "2668", "1F5FF", "1F3AA", "1F3AD", "1F4CD", "1F6A9", "1F1E8-1F1F3", "1F1FA-1F1F8", "1F1EE-1F1F3", "1F1EF-1F1F5", "1F1E7-1F1F7", "1F1F7-1F1FA", "1F1E9-1F1EA", "1F1EC-1F1E7", "1F1EB-1F1F7", "1F1F2-1F1FD", "1F1F0-1F1F7", "1F1EE-1F1E9", "1F1FB-1F1F3", "1F1F9-1F1F7", "1F1EE-1F1F9", "1F1EA-1F1F8", "1F1E8-1F1E6", "1F1F5-1F1F1", "1F1E8-1F1F4", "1F1FF-1F1E6", "1F1F2-1F1FE", "1F1E6-1F1FA", "1F1F3-1F1F1", "1F1F8-1F1E6", "1F1E8-1F1F1", "1F1E7-1F1EA", "1F1F8-1F1EA", "1F1F5-1F1F9", "1F1E8-1F1ED", "1F1E6-1F1F9", "1F1EE-1F1F1", "1F1ED-1F1F0", "1F1E9-1F1F0", "1F1EB-1F1EE", "1F1E6-1F1EA", "1F1F3-1F1F4", "1F1F8-1F1EC", "1F1F3-1F1FF", "1F1EE-1F1EA", "1F1F5-1F1F7", "1F1F2-1F1F4"],
        "nature": ["1F436", "1F43A", "1F431", "1F42D", "1F439", "1F430", "1F438", "1F42F", "1F428", "1F43B", "1F437", "1F43D", "1F42E", "1F417", "1F435", "1F412", "1F434", "1F411", "1F418", "1F43C", "1F427", "1F426", "1F424", "1F425", "1F423", "1F414", "1F40D", "1F422", "1F41B", "1F41D", "1F41C", "1F41E", "1F40C", "1F419", "1F41A", "1F420", "1F41F", "1F42C", "1F433", "1F40B", "1F404", "1F40F", "1F400", "1F403", "1F405", "1F407", "1F409", "1F40E", "1F410", "1F413", "1F415", "1F416", "1F401", "1F402", "1F432", "1F40A", "1F42B", "1F42A", "1F406", "1F408", "1F429", "1F43E", "1F490", "1F338", "1F337", "1F340", "1F33B", "1F33A", "1F341", "1F343", "1F342", "1F33F", "1F33E", "1F344", "1F335", "1F334", "1F332", "1F333", "1F330", "1F331", "1F33C", "1F310", "1F31E", "1F31D", "1F31A", "1F311", "1F312", "1F313", "1F314", "1F315", "1F316", "1F317", "1F318", "1F31C", "1F31B", "1F319", "1F30D", "1F30E", "1F30F", "1F30B", "1F30C", "1F320", "2B50", "26C5", "26A1", "2744", "1F300", "1F301", "1F308", "1F30A"]
    },

    echo_data: function () {
        var catId, id, unicode,
            tabs = "<ul id='tabs'>",
            content = "<div class='tab-contents'>";

        content += "";

        for (catId in keyboard.categories) {
            var cat = keyboard.categories[catId];
            tabs += "<li><a href='#" + cat + "'>" + cat + "</a></li>";
            content += "<div id='" + cat + "' class='tab-content'>";

            for (id in keyboard.data[cat])
                content += "<i class='emoji e" + keyboard.data[cat][id] + "'></i>";

            content += "</div>";
        }

        tabs += "</ul>";
        content += "</div>";

        document.getElementById("data").innerHTML += "<div class='emoji-keyboard'>" + tabs + content + "</div>";

        // Grab the tab links and content divs from the page
        var tabListItems = document.getElementById('tabs').childNodes;
        for (var i = 0; i < tabListItems.length; i++) {
            if (tabListItems[i].nodeName == "LI") {
                var tabLink = getFirstChildWithTagName(tabListItems[i], 'A');
                var id = getHash(tabLink.getAttribute('href'));
                tabLinks[id] = tabLink;
                contentDivs[id] = document.getElementById(id);
            }
        }

        // Assign onclick events to the tab links, and
        // highlight the first tab
        var i = 0;

        for (var id in tabLinks) {
            tabLinks[id].onclick = showTab;
            tabLinks[id].onfocus = function () {
                this.blur()
            };
            if (i == 0) tabLinks[id].parentElement.className = 'selected';
            i++;
        }

        // Hide all content divs except the first
        var i = 0;

        for (var id in contentDivs) {
            if (i != 0) contentDivs[id].className = 'tab-content hide';
            i++;
            i++;
        }
    }
}

function showTab() {
    var selectedId = getHash(this.getAttribute('href'));

    // Highlight the selected tab, and dim all others.
    // Also show the selected content div, and hide all others.
    for (var id in contentDivs) {
        if (id == selectedId) {
            tabLinks[id].parentElement.className = 'selected';
            contentDivs[id].className = 'tab-content';
        } else {
            tabLinks[id].parentElement.className = '';
            contentDivs[id].className = 'tab-content hide';
        }
    }

    // Stop the browser following the link
    return false;
}

function getFirstChildWithTagName(element, tagName) {
    for (var i = 0; i < element.childNodes.length; i++) {
        if (element.childNodes[i].nodeName == tagName) return element.childNodes[i];
    }
}

function getHash(url) {
    var hashPos = url.lastIndexOf('#');
    return url.substring(hashPos + 1);
}

//
//}).call(function(){
//    return this || (typeof window !== 'undefined' ? window : global);
//}());