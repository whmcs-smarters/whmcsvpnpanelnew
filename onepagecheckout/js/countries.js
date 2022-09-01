var states = new Array;
states["AU"] = ["Australian Capital Territory", "New South Wales", "Northern Territory", "Queensland", "South Australia", "Tasmania", "Victoria", "Western Australia", "end"];
states["BR"] = ["AC", "AL", "AP", "AM", "BA", "CE", "DF", "ES", "GO", "MA", "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", "RJ", "RN", "RS", "RO", "RR", "SC", "SP", "SE", "TO", "end"];
states["CA"] = ["Alberta", "British Columbia", "Manitoba", "New Brunswick", "Newfoundland", "Northwest Territories", "Nova Scotia", "Nunavut", "Ontario", "Prince Edward Island", "Quebec", "Saskatchewan", "Yukon Territory", "end"];
states["FR"] = ["Ain", "Aisne", "Allier", "Alpes-de-Haute-Provence", "Hautes-Alpes", "Alpes-Maritimes", "Ardèche", "Ardennes", "Ariège", "Aube", "Aude", "Aveyron", "Bouches-du-Rhône", "Calvados", "Cantal", "Charente", "Charente-Maritime", "Cher", "Corrèze", "Corse-du-Sud", "Haute-Corse", "Côte-d'Or", "Côtes-d'Armor", "Creuse", "Dordogne", "Doubs", "Drôme", "Eure", "Eure-et-Loir", "Finistère", "Gard", "Haute-Garonne", "Gers", "Gironde", "Hérault", "Ille-et-Vilaine", "Indre", "Indre-et-Loire", "Isère", "Jura", "Landes", "Loir-et-Cher", "Loire", "Haute-Loire", "Loire-Atlantique", "Loiret", "Lot", "Lot-et-Garonne", "Lozère", "Maine-et-Loire", "Manche", "Marne", "Haute-Marne", "Mayenne", "Meurthe-et-Moselle", "Meuse", "Morbihan", "Moselle", "Nièvre", "Nord", "Oise", "Orne", "Pas-de-Calais", "Puy-de-Dôme", "Pyrénées-Atlantiques", "Hautes-Pyrénées", "Pyrénées-Orientales", "Bas-Rhin", "Haut-Rhin", "Rhône", "Haute-Saône", "Saône-et-Loire", "Sarthe", "Savoie", "Haute-Savoie", "Paris", "Seine-Maritime", "Seine-et-Marne", "Yvelines", "Deux-Sèvres", "Somme", "Tarn", "Tarn-et-Garonne", "Var", "Vaucluse", "Vendée", "Vienne", "Haute-Vienne", "Vosges", "Yonne", "Territoire de Belfort", "Essonne", "Hauts-de-Seine", "Seine-Saint-Denis", "Val-de-Marne", "Val-d'Oise", "Guadeloupe", "Martinique", "Guyane", "La Réunion", "Mayotte", "end"];
states["DE"] = ["Baden-Wuerttemberg", "Bayern", "Berlin", "Brandenburg", "Bremen", "Hamburg", "Hessen", "Mecklenburg-Vorpommern", "Niedersachsen", "Nordrhein-Westfalen", "Rheinland-Pfalz", "Saarland", "Sachsen", "Sachsen-Anhalt", "Schleswig-Holstein", "Thueringen", "end"];
states["ES"] = ["ARABA", "ALBACETE", "ALICANTE", "ALMERIA", "AVILA", "BADAJOZ", "ILLES BALEARS", "BARCELONA", "BURGOS", "CACERES", "CADIZ", "CASTELLON", "CIUDAD REAL", "CORDOBA", "CORUÑA, A", "CUENCA", "GIRONA", "GRANADA", "GUADALAJARA", "GIPUZKOA", "HUELVA", "HUESCA", "JAEN", "LEON", "LLEIDA", "RIOJA, LA", "LUGO", "MADRID", "MALAGA", "MURCIA", "NAVARRA", "OURENSE", "ASTURIAS", "PALENCIA", "PALMAS, LAS", "PONTEVEDRA", "SALAMANCA", "SANTA CRUZ DE TENERIFE", "CANTABRIA", "SEGOVIA", "SEVILLA", "SORIA", "TARRAGONA", "TERUEL", "TOLEDO", "VALENCIA", "VALLADOLID", "BIZKAIA", "ZAMORA", "ZARAGOZA", "CEUTA", "MELILLA", "end"];
states["IN"] = ["Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", "Delhi", "Goa", "Gujarat", "Haryana", "Himachal Pradesh", "Jammu and Kashmir", "Karnataka", "Kerala", "Madhya Pradesh", "Maharashtra", "Manipur", "Meghalaya", "Mizoram", "Nagaland", "Orissa", "Punjab", "Rajasthan", "Sikkim", "Tamil Nadu", "Tripura", "Uttar Pradesh", "West Bengal", "Andaman and Nicobar Islands", "Chandigarh", "Dadra and Nagar Haveli", "Daman and Diu", "Lakshadweep", "Puducherry", "end"];
states["IT"] = ["AG", "AL", "AN", "AO", "AR", "AP", "AT", "AV", "BA", "BL", "BN", "BG", "BI", "BO", "BZ", "BS", "BR", "CA", "CL", "CB", "CI", "CE", "CT", "CZ", "CH", "CO", "CS", "CR", "KR", "CN", "EN", "FE", "FI", "FG", "FC", "FR", "GE", "GO", "GR", "IM", "IS", "SP", "AQ", "LT", "LE", "LC", "LI", "LO", "LU", "MB", "MC", "MN", "MS", "MT", "ME", "MI", "MO", "NA", "NO", "NU", "OT", "OR", "PD", "PA", "PR", "PV", "PG", "PU", "PE", "PC", "PI", "PT", "PN", "PZ", "PO", "RG", "RA", "RC", "RE", "RI", "RN", "RM", "RO", "SA", "VS", "SS", "SV", "SI", "SR", "SO", "TA", "TE", "TR", "TO", "OG", "TP", "TN", "TV", "TS", "UD", "VA", "VE", "VB", "VC", "VR", "VV", "VI", "VT", "end"];
states["NL"] = ["Drenthe", "Flevoland", "Friesland", "Gelderland", "Groningen", "Limburg", "Noord-Brabant", "Noord-Holland", "Overijssel", "Utrecht", "Zeeland", "Zuid-Holland", "end"];
states["NZ"] = ["Northland", "Auckland", "Waikato", "Bay of Plenty", "Gisborne", "Hawkes Bay", "Taranaki", "Manawatu-Wanganui", "Wellington", "Tasman", "Nelson", "Marlborough", "West Coast", "Canterbury", "Otago", "Southland", "end"];
states["GB"] = ["Avon", "Aberdeenshire", "Angus", "Argyll and Bute", "Barking and Dagenham", "Barnet", "Barnsley", "Bath and North East Somerset", "Bedfordshire", "Berkshire", "Bexley", "Birmingham", "Blackburn with Darwen", "Blackpool", "Blaenau Gwent", "Bolton", "Bournemouth", "Bracknell Forest", "Bradford", "Brent", "Bridgend", "Brighton and Hove", "Bromley", "Buckinghamshire", "Bury", "Caerphilly", "Calderdale", "Cambridgeshire", "Camden", "Cardiff", "Carmarthenshire", "Ceredigion", "Cheshire", "Cleveland", "City of Bristol", "City of Edinburgh", "City of Kingston upon Hull", "City of London", "Clackmannanshire", "Conwy", "Cornwall", "Coventry", "Croydon", "Cumbria", "Darlington", "Denbighshire", "Derby", "Derbyshire", "Devon", "Doncaster", "Dorset", "Dudley", "Dumfries and Galloway", "Dundee City", "Durham", "Ealing", "East Ayrshire", "East Dunbartonshire", "East Lothian", "East Renfrewshire", "East Riding of Yorkshire", "East Sussex", "Eilean Siar (Western Isles)", "Enfield", "Essex", "Falkirk", "Fife", "Flintshire", "Gateshead", "Glasgow City", "Gloucestershire", "Greenwich", "Gwynedd", "Hackney", "Halton", "Hammersmith and Fulham", "Hampshire", "Haringey", "Harrow", "Hartlepool", "Havering", "Herefordshire", "Hertfordshire", "Highland", "Hillingdon", "Hounslow", "Inverclyde", "Isle of Anglesey", "Isle of Wight", "Islington", "Kensington and Chelsea", "Kent", "Kingston upon Thames", "Kirklees", "Knowsley", "Lambeth", "Lancashire", "Leeds", "Leicester", "Leicestershire", "Lewisham", "Lincolnshire", "Liverpool", "London", "Luton", "Manchester", "Medway", "Merthyr Tydfil", "Merton", "Merseyside", "Middlesbrough", "Middlesex", "Midlothian", "Milton Keynes", "Monmouthshire", "Moray", "Neath Port Talbot", "Newcastle upon Tyne", "Newham", "Newport", "Norfolk", "North Ayrshire", "North East Lincolnshire", "North Lanarkshire", "North Lincolnshire", "North Somerset", "North Tyneside", "North Yorkshire", "Northamptonshire", "Northumberland", "North Humberside", "Nottingham", "Nottinghamshire", "Oldham", "Orkney Islands", "Oxfordshire", "Pembrokeshire", "Perth and Kinross", "Peterborough", "Plymouth", "Poole", "Portsmouth", "Powys", "Reading", "Redbridge", "Renfrewshire", "Rhondda Cynon Taff", "Richmond upon Thames", "Rochdale", "Rotherham", "Rutland", "Salford", "Sandwell", "Sefton", "Sheffield", "Shetland Islands", "Shropshire", "Slough", "Solihull", "Somerset", "South Ayrshire", "South Humberside", "South Gloucestershire", "South Lanarkshire", "South Tyneside", "Southampton", "Southend-on-Sea", "Southwark", "South Yorkshire", "St. Helens", "Staffordshire", "Stirling", "Stockport", "Stockton-on-Tees", "Stoke-on-Trent", "Suffolk", "Sunderland", "Surrey", "Sutton", "Swansea", "Swindon", "Tameside", "Telford and Wrekin", "The Scottish Borders", "The Vale of Glamorgan", "Thurrock", "Torbay", "Torfaen", "Tower Hamlets", "Trafford", "Tyne and Wear", "Wakefield", "Walsall", "Waltham Forest", "Wandsworth", "Warrington", "Warwickshire", "West Midlands", "West Dunbartonshire", "West Lothian", "West Sussex", "West Yorkshire", "Westminster", "Wigan", "Wiltshire", "Windsor and Maidenhead", "Wirral", "Wokingham", "Wolverhampton", "Worcestershire", "Wrexham", "York", "Co. Antrim", "Co. Armagh", "Co. Down", "Co. Fermanagh", "Co. Londonderry", "Co. Tyrone", "end"];
states["US"] = ["Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "District of Columbia", "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Carolina", "North Dakota", "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming", "end"];
jQuery(document).ready(function() {
    jQuery("input[name=state]").attr("id", "stateinput");
    jQuery("select[name=country]").change(function() {
        statechange()
    });
    statechange()
});

function statechange() {
    var state = jQuery("#stateinput").val();
    var country = jQuery("select[name=country]").val();
    if (typeof statesTab == "undefined") statesTab = "";
    if (states[country]) {
        jQuery("#stateinput").hide();
        jQuery("#stateinput").removeAttr("name");
        jQuery("#stateselect").remove();
        var stateops = "";
        for (key in states[country]) {
            stateval = states[country][key];
            if (stateval == "end") break;
            stateops += "<option";
            if (stateval == state) stateops += ' selected="selected"';
            stateops += ">" + stateval + "</option>"
        }
        if (statesTab != "") {
            statesTab = ' tabindex="' + statesTab + '"'
        }
        jQuery("#stateinput").parent().append('<select name="state" id="stateselect"' + statesTab + ' class="form-control personal-input"><option value="">Choose One...</option>' + stateops + "</select>")
    } else {
        jQuery("#stateselect").remove();
        jQuery("#stateinput").show();
        jQuery("#stateinput").attr("name", "state")
    }
}
jQuery(document).ready(function() {
    $("#vatType").hide();
    $("#vatBusinessName").hide();
    $("#vatBusinessActivity").hide();
    $("#vatNumber").hide();
    toggleVatOptions()
});
var $ = jQuery.noConflict();
$(document).on("change", "#country", function() {
    var country = checkCountry($("#country").val());
    $("#vatType").hide();
    $("#vatBusinessName").hide();
    $("#vatBusinessActivity").hide();
    $("#vatNumber").hide();
    $("#vatType select").val(0);
    $("#vatBusinessName input").val("");
    $("#vatBusinessActivity select").val(0);
    $("#vatNumber input").val("");
    if (!country) {
        $("#vatType").hide()
    }
    if (country) {
        if (country == "GB") {
            $("#vatLabel").text("VAT or Business ID")
        } else {
            $("#vatLabel").text("VAT Number")
        }
    }
    if ($('[name="state"]').is("input")) {
        $('[name="state"]').val("")
    }
    if ($('[name="state"]').is("select")) {
        $('[name="state"]').val(0)
    }
});
$(document).on("change", '[name="state"]', function() 
{
    var country = checkCountry($("#country").val());
    var state_exc = checkState($('[name="state"]').val());
    if (country == "GB") {
        $("#vatLabel").text("VAT or Business ID")
    } else {
        $("#vatLabel").text("VAT Number")
    }
    $("#vatType select").val(0);
    $("#vatBusinessName input").val("");
    $("#vatBusinessActivity select").val(0);
    $("#vatNumber input").val("");
    if (country && !state_exc) {
        $("#vatType").show()
    }
    if (country && state_exc || !country) {
        $("#vatType").hide();
        $("#vatBusinessName").hide();
        $("#vatBusinessActivity").hide();
        $("#vatNumber").hide();
        $("#vatNumber input").val("123XXX000")
    }
    opcupdate();
});
$(document).on("change", "#vatType select", function() {
    var vatType = $("#vatType select").val();
    var country = $("#country").val();
    if (vatType != "Personal") {
        $("#vatBusinessName").show();
        $("#vatBusinessActivity").show();
        $("#vatNumber").show();
        $("#vatNumber input").val("")
    } else {
        $("#vatBusinessName input").val("");
        $("#vatBusinessActivity select").val(0);
        $("#vatNumber input").val("");
        $("#vatBusinessName").hide();
        $("#vatBusinessActivity").hide();
        $("#vatNumber").hide();
        $("#vatexempt").val("no")
    }
});
$(document).on("blur", "#vatNumber input", function() {
    var country = $.trim($("#country").val());
    var vat_id = $("#vatNumber input").val();
    regexes = {
        AT: new RegExp("^U[0-9]{8}$", "i"),
        BE: new RegExp("^[0-9]{10}$", "i"),
        BG: new RegExp("^[0-9]{9,10}$", "i"),
        CY: new RegExp("^[0-9]{8}[a-z]$", "i"),
        CZ: new RegExp("^[0-9]{8,9,10}$", "i"),
        DK: new RegExp("^[0-9]{8}$", "i"),
        EE: new RegExp("^[0-9]{9}$", "i"),
        FI: new RegExp("^[0-9]{8}$", "i"),
        FR: new RegExp("^([0-9]{11}|[a-z][0-9]{10}|[0-9]{1}[a-z][0-9]{9}|[a-z]{2}[0-9]{9})$", "i"),
        GB: new RegExp("^[a-z0-9]{4,12}$", "i"),
        DE: new RegExp("^[0-9]{9}$", "i"),
        EL: new RegExp("^[0-9]{9}$", "i"),
        HU: new RegExp("^[0-9]{8}$", "i"),
        IE: new RegExp("^([0-9]{7}[a-z]|[0-9]{1}[a-z][0-9]{5}[a-z])$", "i"),
        IT: new RegExp("^[0-9]{11}$", "i"),
        LV: new RegExp("^[0-9]{11}$", "i"),
        LT: new RegExp("^[0-9]{9,12}$", "i"),
        LU: new RegExp("^[0-9]{8}$", "i"),
        MT: new RegExp("^[0-9]{8}$", "i"),
        NL: new RegExp("^[0-9]{9}B[0-9]{2}$", "i"),
        PL: new RegExp("^[0-9]{10}$", "i"),
        PT: new RegExp("^[0-9]{9}$", "i"),
        RO: new RegExp("^[0-9]{2,10}$", "i"),
        SK: new RegExp("^[0-9]{10}$", "i"),
        SI: new RegExp("^[0-9]{8}$", "i"),
        ES: new RegExp("^([a-z][0-9]{8}|[0-9]{8}[a-z]|[a-z][0-9]{7}[a-z])$", "i"),
        SE: new RegExp("^[0-9]{12}$", "i")
    };
    regex = regexes[country];
    if (!regex.exec(vat_id)) {
        $("#vatexempt").val("no");
        alert("Vat ID: " + vat_id + " is not valid!")
    } else {
        $("#vatexempt").val("yes")
    }
});

function toggleVatOptions() {
    var country = checkCountry($("#country").val());
    var state_exc = checkState($('[name="state"]').val());
    if (country && !state_exc && vatType != "Personal") {
        $("#vatType").show();
        $("#vatBusinessName").show();
        $("#vatBusinessActivity").show();
        $("#vatNumber").show()
    }
}

function checkCountry(country) {
    var country = $("#country").val();
    var country_list = ["AT", "BE", "BG", "CY", "CZ", "DK", "EE", "FI", "FR", "GB", "GR", "DE", "EL", "HU", "IE", "IT", "LV", "LT", "LU", "MT", "NL", "PL", "PT", "RO", "SK", "SI", "ES", "SE"];
    var country_regex = new RegExp("\\b" + country + "\\b", "i");
    country = country_regex.exec(country_list.join());
    if (country) {
        return true
    } else {
        return false
    }
}

function checkState(state) {
    var state = $('[name="state"]').val();
    var state_exc_list = ["Andorra", "The Channel Islands", "Gibraltar", "Mount Athos", "San Marino", "Vatican City", "Faroe Islands", "Greenland", "Aland Islands", "Guadeloupe", "Martinique", "Reunion", "St. Pierre", "Miquelon", "French Guiana", "Busingen", "Isle of Heligoland", "Livigno", "Campione d'Italia", "Lake Lugano", "Ceuta", "Melilla", "Canary Islands"];
    var state_regex = new RegExp("\\b" + state + "\\b", "i");
    state_exc = state_regex.exec(state_exc_list.join());
    if (state_exc) {
        return true
    } else {
        return false
    }
}

function passwordStrength(password, submit) {
    submit = submit || false;
    var score = 0;
    var minLength = 8;
    var preventForm = true;
    var minScore = 40;
    var reqPoints = 10;
    var extPoints = 10;
    var maxScore = 50;
    var requireMatch = false;
    if (password.length >= minLength) score = score + reqPoints;
    if (password.match(/[a-z]/) && password.match(/[A-Z]/)) score = score + extPoints;
    if (password.match(/\d+/) && password.match(/[a-z]/i)) score = score + reqPoints;
    if (password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) score = score + extPoints;
    if (password.length > 12) score = score + extPoints;
    if (password.length > 18) score = score + extPoints;
    if ($("#password").val() == $("#cpassword").val()) {
        $("#password").css("border", "2px solid green");
        $("#cpassword").css("border", "2px solid green");
        var pwMatch = true
    } else {
        $("#password").css("border", "2px solid red");
        $("#cpassword").css("border", "2px solid red");
        if (requireMatch) {
            score = 0
        }
        var pwMatch = false
    }
    if (score > 0) {
        perScore = score / maxScore * 100
    } else {
        perScore = 0
    }
    if (perScore == 0) {
        var color = "progress-bar-danger";
        var message = "Very Weak"
    }
    if (perScore <= 49) {
        var color = "progress-bar-danger";
        var message = "Weak"
    }
    if (perScore <= 74 && perScore >= 50) {
        var color = "progress-bar-warning";
        var message = "Acceptable"
    }
    if (perScore >= 75) {
        var color = "progress-bar-success";
        var message = "Good"
    }
    if (perScore >= 85) {
        var message = "Strong"
    }
    if (perScore >= 95) {
        var message = "Strongest!"
    }
    if (score >= minScore && password.length >= minLength) {
        $(".progress-msg").text(message);
        $("#password-progress").css("width", perScore + "%");
        $("#password-progress").removeClass("progress-bar-success progress-bar-danger progress-bar-warning");
        $("#password-progress").addClass(color);
        if (submit == true) {
            return true
        }
    } else {
        $(".progress-msg").text(message);
        $("#password-progress").css("width", perScore + "%");
        $("#password-progress").removeClass("progress-bar-success progress-bar-danger progress-bar-warning");
        $("#password-progress").addClass(color);
        if (submit == true && preventForm == true) {
            return false
        }
    }
}
(function(p, z) {
    function q(a) {
        return !!("" === a || a && a.charCodeAt && a.substr)
    }

    function m(a) {
        return u ? u(a) : "[object Array]" === v.call(a)
    }

    function r(a) {
        return "[object Object]" === v.call(a)
    }

    function s(a, b) {
        var d, a = a || {},
            b = b || {};
        for (d in b) b.hasOwnProperty(d) && null == a[d] && (a[d] = b[d]);
        return a
    }

    function j(a, b, d) {
        var c = [],
            e, h;
        if (!a) return c;
        if (w && a.map === w) return a.map(b, d);
        for (e = 0, h = a.length; e < h; e++) c[e] = b.call(d, a[e], e, a);
        return c
    }

    function n(a, b) {
        a = Math.round(Math.abs(a));
        return isNaN(a) ? b : a
    }

    function x(a) {
        var b = c.settings.currency.format;
        "function" === typeof a && (a = a());
        return q(a) && a.match("%v") ? {
            pos: a,
            neg: a.replace("-", "").replace("%v", "-%v"),
            zero: a
        } : !a || !a.pos || !a.pos.match("%v") ? !q(b) ? b : c.settings.currency.format = {
            pos: b,
            neg: b.replace("%v", "-%v"),
            zero: b
        } : a
    }
    var c = {
            version: "0.4.1",
            settings: {
                currency: {
                    symbol: "$",
                    format: "%s%v",
                    decimal: ".",
                    thousand: ",",
                    precision: 2,
                    grouping: 3
                },
                number: {
                    precision: 0,
                    grouping: 3,
                    thousand: ",",
                    decimal: "."
                }
            }
        },
        w = Array.prototype.map,
        u = Array.isArray,
        v = Object.prototype.toString,
        o = c.unformat = c.parse = function(a, b) {
            if (m(a)) return j(a, function(a) {
                return o(a, b)
            });
            a = a || 0;
            if ("number" === typeof a) return a;
            var b = b || ".",
                c = RegExp("[^0-9-" + b + "]", ["g"]),
                c = parseFloat(("" + a).replace(/\((.*)\)/, "-$1").replace(c, "").replace(b, "."));
            return !isNaN(c) ? c : 0
        },
        y = c.toFixed = function(a, b) {
            var b = n(b, c.settings.number.precision),
                d = Math.pow(10, b);
            return (Math.round(c.unformat(a) * d) / d).toFixed(b)
        },
        t = c.formatNumber = c.format = function(a, b, d, i) {
            if (m(a)) return j(a, function(a) {
                return t(a, b, d, i)
            });
            var a = o(a),
                e = s(r(b) ? b : {
                    precision: b,
                    thousand: d,
                    decimal: i
                }, c.settings.number),
                h = n(e.precision),
                f = 0 > a ? "-" : "",
                g = parseInt(y(Math.abs(a || 0), h), 10) + "",
                l = 3 < g.length ? g.length % 3 : 0;
            return f + (l ? g.substr(0, l) + e.thousand : "") + g.substr(l).replace(/(\d{3})(?=\d)/g, "$1" + e.thousand) + (h ? e.decimal + y(Math.abs(a), h).split(".")[1] : "")
        },
        A = c.formatMoney = function(a, b, d, i, e, h) {
            if (m(a)) return j(a, function(a) {
                return A(a, b, d, i, e, h)
            });
            var a = o(a),
                f = s(r(b) ? b : {
                    symbol: b,
                    precision: d,
                    thousand: i,
                    decimal: e,
                    format: h
                }, c.settings.currency),
                g = x(f.format);
            return (0 < a ? g.pos : 0 > a ? g.neg : g.zero).replace("%s", f.symbol).replace("%v", t(Math.abs(a), n(f.precision), f.thousand, f.decimal))
        };
    c.formatColumn = function(a, b, d, i, e, h) {
        if (!a) return [];
        var f = s(r(b) ? b : {
                symbol: b,
                precision: d,
                thousand: i,
                decimal: e,
                format: h
            }, c.settings.currency),
            g = x(f.format),
            l = g.pos.indexOf("%s") < g.pos.indexOf("%v") ? !0 : !1,
            k = 0,
            a = j(a, function(a) {
                if (m(a)) return c.formatColumn(a, f);
                a = o(a);
                a = (0 < a ? g.pos : 0 > a ? g.neg : g.zero).replace("%s", f.symbol).replace("%v", t(Math.abs(a), n(f.precision), f.thousand, f.decimal));
                if (a.length > k) k = a.length;
                return a
            });
        return j(a, function(a) {
            return q(a) && a.length < k ? l ? a.replace(f.symbol, f.symbol + Array(k - a.length + 1).join(" ")) : Array(k - a.length + 1).join(" ") + a : a
        })
    };
    if ("undefined" !== typeof exports) {
        if ("undefined" !== typeof module && module.exports) exports = module.exports = c;
        exports.accounting = c
    } else "function" === typeof define && define.amd ? define([], function() {
        return c
    }) : (c.noConflict = function(a) {
        return function() {
            p.accounting = a;
            c.noConflict = z;
            return c
        }
    }(p.accounting), p.accounting = c)
})(this);