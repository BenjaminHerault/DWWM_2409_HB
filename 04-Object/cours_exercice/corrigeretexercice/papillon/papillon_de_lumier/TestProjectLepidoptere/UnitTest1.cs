using bibliothequePapillon;
namespace TestProjectLepidoptere
{
    [TestClass]
    public class UnitTest1
    {
        [TestMethod]
        public void TestMethod1()
        {
            // arrange
            Lepidoptere a = new Lepidoptere("Lepi");
            // act
             a.SeDeplacer();
            // assert

        }
    }
}