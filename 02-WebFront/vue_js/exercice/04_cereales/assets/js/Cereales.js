export class Cereales {
    constructor(
        _id,
        _nom,
        _calories,
        _proteines,
        _sel,
        _fibres,
        _glucides,
        _sucre,
        _potassium,
        _vitamines,
        _evaluation
    ) {
        this.id = _id;
        this.name = _nom;
        this.calories = _calories;
        this.protein = _proteines;
        this.sodium = _sel;
        this.fiber = _fibres;
        this.carbo = _glucides;
        this.sugars = _sucre;
        this.potass = _potassium;
        this.vitamins = _vitamines;
        this.rating = _evaluation;
    }
}
