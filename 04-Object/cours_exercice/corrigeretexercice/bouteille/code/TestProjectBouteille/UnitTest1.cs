using ClassLibraryBouteille;
namespace TestProjectBouteille
{
    [TestClass]
    public class TestBouteille
    {
        [TestMethod]
        public void Ouvrir_Bouteille_Fermee_return_true()
        {
            // arrange
            Bouteille a = new Bouteille(2,2,false); // ce la meme chose que Bouteille b;
            // act
            bool testOuvrir = a.Ouvrir();
            // assert
            Assert.IsTrue(testOuvrir);
            Assert.IsTrue(a.estOuverte);
        }
        [TestMethod]
        public void Ouvrir_Bouteille_Ouverte_return_true()
        {
            // arrange
            Bouteille b = new Bouteille(2, 2, true);
            // act 
            bool testOuvrir = b.Ouvrir();
            // assert
            Assert.IsFalse(testOuvrir);     // on peux pas ouvrire la bouteille car elle et déjà ouvete !
            Assert.IsTrue(b.estOuverte);    //on dit que ce vrai car la bouteille et déjà ouverte
        }
        [TestMethod]
        public void Test_Ouvrir_retourne_true3()
        {
            // arrange

            // act 
            // assert
        }
        [TestMethod]
        public void Test_Ouvrir_retourne_true4()
        {
            // arrange

            // act 
            // assert
        }
        [TestMethod]
        public void Test_Ouvrir_retourne_true5()
        {
            // arrange

            // act 
            // assert
        }
        [TestMethod]
        public void Test_Ouvrir_retourne_true6()
        {
            // arrange

            // act 
            // assert
        }
    }
}